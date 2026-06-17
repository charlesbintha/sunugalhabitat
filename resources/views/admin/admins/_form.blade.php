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
      <label for="name">Nom</label>
      <input id="name" type="text" name="name" value="{{ old('name', $adminUser->name) }}" required>
    </div>

    <div class="field">
      <label for="email">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email', $adminUser->email) }}" required>
    </div>
  </div>

  <div class="grid-2">
    <div class="field">
      <label for="password">{{ $isEdit ? 'Nouveau mot de passe' : 'Mot de passe' }}</label>
      <input id="password" type="password" name="password" {{ $isEdit ? '' : 'required' }}>
      <div class="hint">{{ $isEdit ? 'Laissez vide pour conserver le mot de passe actuel.' : 'Minimum 8 caracteres.' }}</div>
    </div>

    <div class="field">
      <label>Statut</label>
      <label class="checkbox">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $adminUser->is_active ?? true) ? 'checked' : '' }}>
        <span>Compte admin actif</span>
      </label>
    </div>
  </div>

  <div class="form-actions">
    <button class="btn btn-primary" type="submit">{{ $submitLabel }}</button>
    <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">Annuler</a>
  </div>
</div>
