@csrf

@if ($errors->any())
  <div class="errors">
    @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
    @endforeach
  </div>
@endif

<div class="admin-panel">
  <div class="grid-2">
    <div class="field">
      <label for="title">Titre</label>
      <input id="title" type="text" name="title" value="{{ old('title', $product->title) }}" required>
    </div>

    <div class="field">
      <label for="slug">Slug</label>
      <input id="slug" type="text" name="slug" value="{{ old('slug', $product->slug) }}">
      <div class="hint">Laissez vide pour le generer automatiquement.</div>
    </div>
  </div>

  <div class="grid-4">
    <div class="field">
      <label for="type">Type</label>
      <input id="type" type="text" name="type" value="{{ old('type', $product->type) }}" required>
    </div>

    <div class="field">
      <label for="location">Localisation</label>
      <input id="location" type="text" name="location" value="{{ old('location', $product->location) }}" required>
    </div>

    <div class="field">
      <label for="price">Prix</label>
      <input id="price" type="text" name="price" value="{{ old('price', $product->price) }}">
    </div>

    <div class="field">
      <label for="sort_order">Ordre</label>
      <input id="sort_order" type="number" min="0" name="sort_order" value="{{ old('sort_order', $product->sort_order ?? 0) }}">
    </div>
  </div>

  <div class="grid-4">
    <div class="field">
      <label for="surface">Surface</label>
      <input id="surface" type="text" name="surface" value="{{ old('surface', $product->surface) }}" required>
    </div>

    <div class="field">
      <label for="beds">Chambres</label>
      <input id="beds" type="text" name="beds" value="{{ old('beds', $product->beds) }}" required>
    </div>

    <div class="field">
      <label for="baths">Salles de bain</label>
      <input id="baths" type="text" name="baths" value="{{ old('baths', $product->baths) }}" required>
    </div>

    <div class="field">
      <label>Statut</label>
      <label class="checkbox">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
        <span>Produit visible sur le site</span>
      </label>
    </div>
  </div>

  <div class="grid-2">
    <div class="field">
      <label for="card_image">Image carte</label>
      <input id="card_image" type="text" name="card_image" value="{{ old('card_image', $product->card_image) }}">
      <div class="hint">Chemin existant ou laissez vide et utilisez un upload.</div>
    </div>

    <div class="field">
      <label for="card_image_file">Upload image carte</label>
      <input id="card_image_file" type="file" name="card_image_file" accept="image/*">
    </div>
  </div>

  <div class="grid-2">
    <div class="field">
      <label for="hero_image">Image hero</label>
      <input id="hero_image" type="text" name="hero_image" value="{{ old('hero_image', $product->hero_image) }}">
    </div>

    <div class="field">
      <label for="hero_image_file">Upload image hero</label>
      <input id="hero_image_file" type="file" name="hero_image_file" accept="image/*">
    </div>
  </div>

  <div class="grid-2">
    <div class="field">
      <label for="gallery_image_1">Galerie 1</label>
      <input id="gallery_image_1" type="text" name="gallery_image_1" value="{{ old('gallery_image_1', $product->gallery_image_1) }}">
    </div>

    <div class="field">
      <label for="gallery_image_1_file">Upload galerie 1</label>
      <input id="gallery_image_1_file" type="file" name="gallery_image_1_file" accept="image/*">
    </div>
  </div>

  <div class="grid-2">
    <div class="field">
      <label for="gallery_image_2">Galerie 2</label>
      <input id="gallery_image_2" type="text" name="gallery_image_2" value="{{ old('gallery_image_2', $product->gallery_image_2) }}">
    </div>

    <div class="field">
      <label for="gallery_image_2_file">Upload galerie 2</label>
      <input id="gallery_image_2_file" type="file" name="gallery_image_2_file" accept="image/*">
    </div>
  </div>

  <div class="field">
    <label for="summary">Resume</label>
    <textarea id="summary" name="summary" required>{{ old('summary', $product->summary) }}</textarea>
  </div>

  <div class="grid-2">
    <div class="field">
      <label for="description_1">Description 1</label>
      <textarea id="description_1" name="description_1" required>{{ old('description_1', $product->description_1) }}</textarea>
    </div>

    <div class="field">
      <label for="description_2">Description 2</label>
      <textarea id="description_2" name="description_2" required>{{ old('description_2', $product->description_2) }}</textarea>
    </div>
  </div>

  <div class="grid-2">
    <div class="field">
      <label for="amenities_title">Titre des atouts</label>
      <input id="amenities_title" type="text" name="amenities_title" value="{{ old('amenities_title', $product->amenities_title) }}" required>
    </div>

    <div class="field">
      <label for="amenities_text">Texte des atouts</label>
      <textarea id="amenities_text" name="amenities_text" required>{{ old('amenities_text', $product->amenities_text) }}</textarea>
    </div>
  </div>

  <div class="field">
    <label for="amenities_input">Liste des atouts</label>
    <textarea id="amenities_input" name="amenities_input" required>{{ old('amenities_input', implode(PHP_EOL, $product->amenities ?? [])) }}</textarea>
    <div class="hint">Un atout par ligne.</div>
  </div>

  <div class="form-actions">
    <button class="btn btn-primary" type="submit">{{ $submitLabel }}</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Annuler</a>
  </div>
</div>
