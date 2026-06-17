@extends('admin.layout')

@section('title', 'Connexion admin')

@section('body')
  <div class="login-shell">
    <div class="login-card">
      <div class="admin-brand" style="color:#0f2f57;">
        Sunugal Habitat
        <span>Administration</span>
      </div>

      <h1 class="admin-title" style="font-size:28px;">Connexion</h1>
      <p class="admin-subtitle">Accedez a la gestion des produits.</p>

      @if ($errors->any())
        <div class="errors">
          @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      <form method="POST" action="{{ route('admin.login.store') }}">
        @csrf

        <div class="field">
          <label for="email">Email</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="field">
          <label for="password">Mot de passe</label>
          <input id="password" type="password" name="password" required>
        </div>

        <label class="checkbox">
          <input type="checkbox" name="remember" value="1">
          <span>Rester connecte</span>
        </label>

        <div class="form-actions" style="margin-top:24px;">
          <button class="btn btn-primary" type="submit">Se connecter</button>
          <a class="btn btn-secondary" href="{{ route('home') }}">Retour au site</a>
        </div>
      </form>
    </div>
  </div>
@endsection
