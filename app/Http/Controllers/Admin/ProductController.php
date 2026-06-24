<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

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
            'gallery_image_1_file' => ['nullable', 'image', 'max:5120'],
            'gallery_image_2_file' => ['nullable', 'image', 'max:5120'],
            'summary' => ['required', 'string'],
            'description_1' => ['nullable', 'string'],
            'description_2' => ['nullable', 'string'],
        ]);

        if (! $request->hasFile('hero_image_file') && blank($product->hero_image)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
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

        foreach (['hero_image', 'card_image', 'gallery_image_1', 'gallery_image_2'] as $field) {
            $fileField = $field.'_file';

            if ($request->hasFile($fileField)) {
                $data[$field] = $this->storeImage($request->file($fileField));
            }
        }

        $heroImage = $product->hero_image;

        if ($request->hasFile('hero_image_file')) {
            $heroImage = $data['hero_image'];
        }

        $data['hero_image'] = $heroImage;
        $data['card_image'] = $product->card_image ?: $heroImage;
        $data['gallery_image_1'] = $product->gallery_image_1 ?: $heroImage;
        $data['gallery_image_2'] = $product->gallery_image_2 ?: $heroImage;

        if ($request->hasFile('card_image_file')) {
            $data['card_image'] = $data['card_image'];
        }

        if ($request->hasFile('gallery_image_1_file')) {
            $data['gallery_image_1'] = $data['gallery_image_1'];
        }

        if ($request->hasFile('gallery_image_2_file')) {
            $data['gallery_image_2'] = $data['gallery_image_2'];
        }

        unset(
            $data['hero_image_file'],
            $data['card_image_file'],
            $data['gallery_image_1_file'],
            $data['gallery_image_2_file'],
        );

        $product->fill($data)->save();
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
}
