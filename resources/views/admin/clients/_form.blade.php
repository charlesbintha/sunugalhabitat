@csrf

<div class="admin-panel">
  <div class="grid-2">
    <div class="field">
      <label for="name">Nom du client</label>
      <input id="name" type="text" name="name" value="{{ old('name', $client->name) }}" placeholder="Ex: Mamadou Ndiaye" required>
    </div>

    <div class="field">
      <label for="email">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email', $client->email) }}" placeholder="Ex: client@email.com">
    </div>

    <div class="field">
      <label for="phone">Telephone</label>
      <input id="phone" type="text" name="phone" value="{{ old('phone', $client->phone) }}" placeholder="Ex: +221 77 000 00 00">
    </div>

    <div class="field">
      <label for="city">Ville / Quartier</label>
      <input id="city" type="text" name="city" value="{{ old('city', $client->city) }}" placeholder="Ex: Dakar - Point E">
    </div>
  </div>

  <div class="field">
    <label for="address">Adresse</label>
    <input id="address" type="text" name="address" value="{{ old('address', $client->address) }}" placeholder="Ex: Avenue Cheikh Anta Diop, Dakar">
  </div>

  <div class="field">
    <label for="notes">Notes</label>
    <textarea id="notes" name="notes" placeholder="Infos utiles, contexte commercial, preferences...">{{ old('notes', $client->notes) }}</textarea>
  </div>

  <label class="checkbox">
    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $client->is_active ?? true) ? 'checked' : '' }}>
    <span>Client actif</span>
  </label>

  <div class="form-actions">
    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
    <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">Annuler</a>
  </div>
</div>
