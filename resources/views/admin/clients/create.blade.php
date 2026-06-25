@extends('admin.layout')

@section('title', 'Ajouter un client')

@section('body')
  <div class="admin-shell">
    @include('admin.partials.sidebar')

    <main class="admin-content">
      <div class="admin-topbar">
        <div>
          <h1 class="admin-title">Ajouter un client</h1>
          <div class="admin-subtitle">Le client sera disponible dans la creation des factures.</div>
        </div>
      </div>

      @if ($errors->any())
        <div class="errors">
          @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      <form method="POST" action="{{ route('admin.clients.store') }}">
        @include('admin.clients._form', ['submitLabel' => 'Enregistrer'])
      </form>
    </main>
  </div>
@endsection
