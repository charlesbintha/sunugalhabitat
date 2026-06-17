@extends('admin.layout')

@section('title', 'Ajouter un admin')

@section('body')
  <div class="admin-shell">
    @include('admin.partials.sidebar')

    <main class="admin-content">
      <div class="admin-topbar">
        <div>
          <h1 class="admin-title">Ajouter un admin</h1>
          <div class="admin-subtitle">Ce compte pourra acceder au back-office.</div>
        </div>
      </div>

      <form method="POST" action="{{ route('admin.admins.store') }}">
        @include('admin.admins._form', ['submitLabel' => 'Enregistrer', 'isEdit' => false])
      </form>
    </main>
  </div>
@endsection
