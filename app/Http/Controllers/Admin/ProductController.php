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
                'amenities_title' => 'Atouts du produit',
                'amenities_text' => 'Resumez ici les points forts du bien.',
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
            'slug' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'price' => ['nullable', 'string', 'max:255'],
            'surface' => ['required', 'string', 'max:255'],
            'beds' => ['required', 'string', 'max:50'],
            'baths' => ['required', 'string', 'max:50'],
            'hero_image' => ['nullable', 'string', 'max:255'],
            'card_image' => ['nullable', 'string', 'max:255'],
            'gallery_image_1' => ['nullable', 'string', 'max:255'],
            'gallery_image_2' => ['nullable', 'string', 'max:255'],
            'hero_image_file' => ['nullable', 'image', 'max:5120'],
            'card_image_file' => ['nullable', 'image', 'max:5120'],
            'gallery_image_1_file' => ['nullable', 'image', 'max:5120'],
            'gallery_image_2_file' => ['nullable', 'image', 'max:5120'],
            'summary' => ['required', 'string'],
            'description_1' => ['required', 'string'],
            'description_2' => ['required', 'string'],
            'amenities_title' => ['required', 'string', 'max:255'],
            'amenities_text' => ['required', 'string'],
            'amenities_input' => ['required', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['slug'] = $this->buildUniqueSlug($data['slug'] ?: $data['title'], $product);
        $data['price'] = $data['price'] ?: 'Sur demande';
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');
        $data['amenities'] = $this->normalizeAmenities($data['amenities_input']);

        foreach (['hero_image', 'card_image', 'gallery_image_1', 'gallery_image_2'] as $field) {
            $fileField = $field.'_file';

            if ($request->hasFile($fileField)) {
                $data[$field] = $this->storeImage($request->file($fileField));
            }
        }

        unset(
            $data['hero_image_file'],
            $data['card_image_file'],
            $data['gallery_image_1_file'],
            $data['gallery_image_2_file'],
            $data['amenities_input'],
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

    protected function normalizeAmenities(string $input): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $input) ?: [])
            ->map(fn (string $amenity) => trim($amenity))
            ->filter()
            ->values()
            ->all();
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
