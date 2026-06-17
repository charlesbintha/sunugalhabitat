@extends('admin.layout')

@section('title', 'Ajouter un produit')

@section('body')
  <div class="admin-shell">
    @include('admin.partials.sidebar')

    <main class="admin-content">
      <div class="admin-topbar">
        <div>
          <h1 class="admin-title">Ajouter un produit</h1>
          <div class="admin-subtitle">Le produit sera visible si vous le laissez actif.</div>
        </div>
      </div>

      <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @include('admin.products._form', ['submitLabel' => 'Enregistrer'])
      </form>
    </main>
  </div>
@endsection
