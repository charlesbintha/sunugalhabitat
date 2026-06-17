@extends('admin.layout')

@section('title', 'Modifier un produit')

@section('body')
  <div class="admin-shell">
    @include('admin.partials.sidebar')

    <main class="admin-content">
      <div class="admin-topbar">
        <div>
          <h1 class="admin-title">Modifier le produit</h1>
          <div class="admin-subtitle">{{ $product->title }}</div>
        </div>
      </div>

      <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.products._form', ['submitLabel' => 'Mettre a jour'])
      </form>
    </main>
  </div>
@endsection
