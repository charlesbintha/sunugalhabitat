@extends('admin.layout')

@section('title', 'Modifier un admin')

@section('body')
  <div class="admin-shell">
    @include('admin.partials.sidebar')

    <main class="admin-content">
      <div class="admin-topbar">
        <div>
          <h1 class="admin-title">Modifier un admin</h1>
          <div class="admin-subtitle">{{ $adminUser->name }}</div>
        </div>
      </div>

      <form method="POST" action="{{ route('admin.admins.update', $adminUser) }}">
        @method('PUT')
        @include('admin.admins._form', ['submitLabel' => 'Mettre a jour', 'isEdit' => true])
      </form>
    </main>
  </div>
@endsection
