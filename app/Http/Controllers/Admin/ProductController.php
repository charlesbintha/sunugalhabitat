<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('admin.products.index', [
            'products' => Product::query()->ordered()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.products.create', [
            'product' => new Product([
                'price' => 'Sur demande',
                'is_active' => true,
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $product = new Product();
        $this->saveProduct($product, $request);

        return redirect()
            ->route('admin.products.index')
            ->with('status', 'Produit ajoute avec succes.');
    }

    public function edit(Product $product): View
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $this->saveProduct($product, $request);

        return redirect()
            ->route('admin.products.index')
            ->with('status', 'Produit mis a jour avec succes.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->deleteManagedImages($this->productImagePaths($product));
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('status', 'Produit supprime.');
    }

    public function toggle(Product $product): RedirectResponse
    {
        $product->update([
            'is_active' => ! $product->is_active,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('status', $product->is_active ? 'Produit active.' : 'Produit desactive.');
    }

    protected function saveProduct(Product $product, Request $request): void
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'price' => ['nullable', 'string', 'max:255'],
            'surface' => ['nullable', 'string', 'max:255'],
            'beds' => ['required', 'string', 'max:50'],
            'baths' => ['nullable', 'string', 'max:50'],
            'hero_image_file' => ['nullable', 'image', 'max:5120'],
            'card_image_file' => ['nullable', 'image', 'max:5120'],
            'gallery_files' => ['nullable', 'array'],
            'gallery_files.*' => ['image', 'max:5120'],
            'remove_card_image' => ['nullable', 'boolean'],
            'remove_gallery_images' => ['nullable', 'array'],
            'remove_gallery_images.*' => ['nullable', 'integer'],
            'summary' => ['required', 'string'],
            'description_1' => ['nullable', 'string'],
            'description_2' => ['nullable', 'string'],
        ]);

        if (! $request->hasFile('hero_image_file') && blank($product->hero_image)) {
            throw ValidationException::withMessages([
                'hero_image_file' => 'L image hero est obligatoire.',
            ]);
        }

        $data['slug'] = $this->buildUniqueSlug($data['title'], $product);
        $data['price'] = $data['price'] ?: 'Sur demande';
        $data['surface'] = $data['surface'] ?: '';
        $data['baths'] = $data['baths'] ?: '';
        $data['description_1'] = $data['description_1'] ?: '';
        $data['description_2'] = $data['description_2'] ?: '';
        $data['sort_order'] = $product->exists
            ? $product->sort_order
            : $this->nextSortOrder();
        $data['is_active'] = $request->boolean('is_active');
        $data['amenities_title'] = '';
        $data['amenities_text'] = '';
        $data['amenities'] = [];
        $existingPaths = $this->productImagePaths($product);

        $heroImage = $request->hasFile('hero_image_file')
            ? $this->storeImage($request->file('hero_image_file'))
            : $product->hero_image;

        if (blank($heroImage)) {
            throw ValidationException::withMessages([
                'hero_image_file' => 'L image hero est obligatoire.',
            ]);
        }

        $cardImage = $product->card_image;

        if ($request->hasFile('card_image_file')) {
            $cardImage = $this->storeImage($request->file('card_image_file'));
        } elseif ($request->boolean('remove_card_image')) {
            $cardImage = null;
        }

        $galleryImages = collect($product->galleryImages());

        $removeIndexes = collect($request->input('remove_gallery_images', []))
            ->map(fn ($index) => (int) $index)
            ->filter(fn ($index) => $index >= 0)
            ->unique()
            ->sortDesc()
            ->values();

        foreach ($removeIndexes as $index) {
            $galleryImages->forget($index);
        }

        $galleryImages = $galleryImages->values();

        foreach ($request->file('gallery_files', []) as $file) {
            $galleryImages->push($this->storeImage($file));
        }

        $galleryImages = $galleryImages
            ->filter(fn ($image) => filled($image))
            ->values();

        $data['hero_image'] = $heroImage;
        $data['card_image'] = $cardImage;
        $data['gallery_images'] = $galleryImages->all();
        $data['gallery_image_1'] = $galleryImages->get(0);
        $data['gallery_image_2'] = $galleryImages->get(1);

        unset(
            $data['hero_image_file'],
            $data['card_image_file'],
            $data['gallery_files'],
            $data['remove_card_image'],
            $data['remove_gallery_images'],
        );

        $product->fill($data)->save();

        $this->deleteManagedImages(array_diff($existingPaths, $this->productImagePaths($product)));
    }

    protected function buildUniqueSlug(string $source, Product $product): string
    {
        $baseSlug = Str::slug($source);
        $slug = $baseSlug !== '' ? $baseSlug : 'produit';
        $suffix = 1;

        while (
            Product::query()
                ->where('slug', $slug)
                ->when($product->exists, fn ($query) => $query->whereKeyNot($product->getKey()))
                ->exists()
        ) {
            $slug = $baseSlug.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }

    protected function nextSortOrder(): int
    {
        return (int) Product::query()->max('sort_order') + 1;
    }

    protected function storeImage(UploadedFile $file): string
    {
        $directory = public_path('uploads/products');

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = Str::uuid()->toString().'.'.$file->getClientOriginalExtension();
        $file->move($directory, $filename);

        return '/uploads/products/'.$filename;
    }

    protected function productImagePaths(Product $product): array
    {
        return collect([
            $product->hero_image,
            $product->card_image,
            $product->gallery_image_1,
            $product->gallery_image_2,
            ...$product->galleryImages(),
        ])
            ->filter(fn ($path) => filled($path))
            ->unique()
            ->values()
            ->all();
    }

    protected function deleteManagedImages(array $paths): void
    {
        foreach ($paths as $path) {
            $this->deleteManagedImage($path);
        }
    }

    protected function deleteManagedImage(?string $path): void
    {
        if (! $this->isManagedUpload($path)) {
            return;
        }

        $absolutePath = public_path(ltrim($path, '/'));

        if (is_file($absolutePath)) {
            @unlink($absolutePath);
        }
    }

    protected function isManagedUpload(?string $path): bool
    {
        return filled($path) && str_starts_with($path, '/uploads/products/');
    }
}
