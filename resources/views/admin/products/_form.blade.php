@csrf

@if ($errors->any())
  <div class="errors">
    @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
    @endforeach
  </div>
@endif

<div class="admin-panel">
  <div class="field">
    <label for="title">Titre</label>
    <input
      id="title"
      type="text"
      name="title"
      value="{{ old('title', $product->title) }}"
      placeholder="Ex: Appartement F3 aux Almadies"
      required
    >
    <div class="hint">Le slug est genere automatiquement a partir du titre.</div>
  </div>

  <div class="grid-4">
    <div class="field">
      <label for="type">Type</label>
      <input id="type" type="text" name="type" value="{{ old('type', $product->type) }}" placeholder="Ex: Appartement, Villa, Immeuble" required>
    </div>

    <div class="field">
      <label for="location">Localisation</label>
      <input id="location" type="text" name="location" value="{{ old('location', $product->location) }}" placeholder="Ex: Dakar - Point E" required>
    </div>

    <div class="field">
      <label for="price">Prix</label>
      <input id="price" type="text" name="price" value="{{ old('price', $product->price) }}" placeholder="Ex: 185 000 000 FCFA ou laissez vide pour Sur demande">
    </div>
  </div>

  <div class="grid-4">
    <div class="field">
      <label for="surface">Surface</label>
      <input id="surface" type="text" name="surface" value="{{ old('surface', $product->surface) }}" placeholder="Ex: 180 m2">
    </div>

    <div class="field">
      <label for="beds">Chambres</label>
      <input id="beds" type="text" name="beds" value="{{ old('beds', $product->beds) }}" placeholder="Ex: 3" required>
    </div>

    <div class="field">
      <label for="baths">Salles de bain</label>
      <input id="baths" type="text" name="baths" value="{{ old('baths', $product->baths) }}" placeholder="Ex: 2">
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
      <label for="hero_image_file">Upload image hero</label>
      <input id="hero_image_file" type="file" name="hero_image_file" accept="image/*">
      <div class="hint">Obligatoire a la creation du produit.</div>
    </div>

    <div class="field">
      <label for="card_image_file">Upload image carte</label>
      <input id="card_image_file" type="file" name="card_image_file" accept="image/*">
      <div class="hint">Optionnel. Si vide, l image hero sera reutilisee.</div>
    </div>
  </div>

  <div class="grid-2">
    <div class="field">
      <label for="gallery_image_1_file">Upload galerie 1</label>
      <input id="gallery_image_1_file" type="file" name="gallery_image_1_file" accept="image/*">
      <div class="hint">Optionnel. Si vide, l image hero sera reutilisee.</div>
    </div>

    <div class="field">
      <label for="gallery_image_2_file">Upload galerie 2</label>
      <input id="gallery_image_2_file" type="file" name="gallery_image_2_file" accept="image/*">
      <div class="hint">Optionnel. Si vide, l image hero sera reutilisee.</div>
    </div>
  </div>

  <div class="field">
    <label for="summary">Resume</label>
    <textarea id="summary" name="summary" placeholder="Resume court du bien, de son emplacement et de son principal avantage." required>{{ old('summary', $product->summary) }}</textarea>
  </div>

  <div class="grid-2">
    <div class="field">
      <label for="description_1">Description 1</label>
      <textarea id="description_1" name="description_1" placeholder="Optionnel: details complementaires sur le bien.">{{ old('description_1', $product->description_1) }}</textarea>
    </div>

    <div class="field">
      <label for="description_2">Description 2</label>
      <textarea id="description_2" name="description_2" placeholder="Optionnel: informations pratiques, usage, environnement, etc.">{{ old('description_2', $product->description_2) }}</textarea>
    </div>
  </div>

  <div class="form-actions">
    <button class="btn btn-primary" type="submit">{{ $submitLabel }}</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Annuler</a>
  </div>
</div>
