@extends('admin.layout')

@section('title', 'Nouvelle facture')

@section('body')
  <div class="admin-shell">
    @include('admin.partials.sidebar')

    <main class="admin-content">
      <div class="admin-topbar">
        <div>
          <h1 class="admin-title">Nouvelle facture</h1>
          <div class="admin-subtitle">Enregistrement en brouillon, puis validation pour verrouiller.</div>
        </div>
      </div>

      @if ($errors->any())
        <div class="errors">
          @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      @if ($clients->isEmpty())
        <div class="empty-state">
          Aucun client actif disponible. Ajoutez d abord un client pour creer une facture.
        </div>
      @else
        <form method="POST" action="{{ route('admin.invoices.store') }}">
          @include('admin.invoices._form', [
            'submitLabel' => 'Enregistrer en brouillon',
            'cancelRoute' => route('admin.invoices.index'),
          ])
        </form>
      @endif
    </main>
  </div>

  @include('admin.invoices._form-scripts')
@endsection
