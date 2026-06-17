@extends('admin.layout')

@section('title', 'Produits admin')

@section('body')
  <div class="admin-shell">
    @include('admin.partials.sidebar')

    <main class="admin-content">
      <div class="admin-topbar">
        <div>
          <h1 class="admin-title">Produits</h1>
          <div class="admin-subtitle">Ajout, modification, suppression et activation.</div>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Ajouter un produit</a>
      </div>

      @if (session('status'))
        <div class="flash">{{ session('status') }}</div>
      @endif

      @if ($errors->any())
        <div class="errors">
          @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      <div class="admin-panel">
        <table>
          <thead>
            <tr>
              <th>Produit</th>
              <th>Type</th>
              <th>Localisation</th>
              <th>Ordre</th>
              <th>Statut</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($products as $product)
              <tr>
                <td>
                  <div style="display:flex; gap:12px; align-items:flex-start;">
                    <img class="thumb" src="{{ $product->card_image }}" alt="{{ $product->title }}">
                    <div>
                      <strong>{{ $product->title }}</strong><br>
                      <span class="admin-subtitle">{{ $product->slug }}</span>
                    </div>
                  </div>
                </td>
                <td>{{ $product->type }}</td>
                <td>{{ $product->location }}</td>
                <td>{{ $product->sort_order }}</td>
                <td>
                  <span class="badge {{ $product->is_active ? 'badge-active' : 'badge-inactive' }}">
                    {{ $product->is_active ? 'Actif' : 'Inactif' }}
                  </span>
                </td>
                <td>
                  <div class="actions">
                    <a class="btn btn-secondary" href="{{ route('admin.products.edit', $product) }}">Modifier</a>

                    <form method="POST" action="{{ route('admin.products.toggle', $product) }}">
                      @csrf
                      @method('PATCH')
                      <button class="btn {{ $product->is_active ? 'btn-warning' : 'btn-success' }}" type="submit">
                        {{ $product->is_active ? 'Desactiver' : 'Activer' }}
                      </button>
                    </form>

                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Supprimer ce produit ?');">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" type="submit">Supprimer</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6">Aucun produit pour le moment.</td>
              </tr>
            @endforelse
          </tbody>
        </table>

        <div style="margin-top:20px;">
          {{ $products->links() }}
        </div>
      </div>
    </main>
  </div>
@endsection
