@extends('admin.layout')

@section('title', 'Admins')

@section('body')
  <div class="admin-shell">
    @include('admin.partials.sidebar')

    <main class="admin-content">
      <div class="admin-topbar">
        <div>
          <h1 class="admin-title">Admins</h1>
          <div class="admin-subtitle">Creation, modification, activation, desactivation et suppression.</div>
        </div>
        <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">Ajouter un admin</a>
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
              <th>Admin</th>
              <th>Email</th>
              <th>Etat</th>
              <th>Acces</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($admins as $admin)
              <tr>
                <td>
                  <strong>{{ $admin->name }}</strong><br>
                  <span class="admin-subtitle">ID #{{ $admin->id }}</span>
                </td>
                <td>{{ $admin->email }}</td>
                <td>
                  <span class="badge {{ $admin->is_active ? 'badge-active' : 'badge-inactive' }}">
                    {{ $admin->is_active ? 'Actif' : 'Inactif' }}
                  </span>
                </td>
                <td>{{ $admin->id === auth()->id() ? 'Votre compte' : 'Admin' }}</td>
                <td>
                  <div class="actions">
                    <a class="btn btn-secondary" href="{{ route('admin.admins.edit', $admin) }}">Modifier</a>

                    <form method="POST" action="{{ route('admin.admins.toggle', $admin) }}">
                      @csrf
                      @method('PATCH')
                      <button class="btn {{ $admin->is_active ? 'btn-warning' : 'btn-success' }}" type="submit">
                        {{ $admin->is_active ? 'Desactiver' : 'Activer' }}
                      </button>
                    </form>

                    <form method="POST" action="{{ route('admin.admins.destroy', $admin) }}" onsubmit="return confirm('Supprimer ce compte admin ?');">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" type="submit">Supprimer</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5">Aucun compte admin trouve.</td>
              </tr>
            @endforelse
          </tbody>
        </table>

        <div style="margin-top:20px;">
          {{ $admins->links() }}
        </div>
      </div>
    </main>
  </div>
@endsection
