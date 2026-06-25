@extends('admin.layout')

@section('title', 'Modifier un client')

@section('body')
  <div class="admin-shell">
    @include('admin.partials.sidebar')

    <main class="admin-content">
      <div class="admin-topbar">
        <div>
          <h1 class="admin-title">Modifier un client</h1>
          <div class="admin-subtitle">{{ $client->name }}</div>
        </div>
      </div>

      @if ($errors->any())
        <div class="errors">
          @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      <form method="POST" action="{{ route('admin.clients.update', $client) }}">
        @csrf
        @method('PUT')
        @include('admin.clients._form', ['submitLabel' => 'Mettre a jour'])
      </form>
    </main>
  </div>
@endsection
