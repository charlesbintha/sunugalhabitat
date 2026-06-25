@extends('admin.layout')

@section('title', 'Clients')

@section('body')
  <div class="admin-shell">
    @include('admin.partials.sidebar')

    <main class="admin-content">
      <div class="admin-topbar">
        <div>
          <h1 class="admin-title">Clients</h1>
          <div class="admin-subtitle">Liste, ajout, modification, activation et suppression.</div>
        </div>
        <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">Ajouter un client</a>
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
              <th>Client</th>
              <th>Contact</th>
              <th>Localisation</th>
              <th>Statut</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($clients as $client)
              <tr>
                <td>
                  <strong>{{ $client->name }}</strong><br>
                  <span class="admin-subtitle">ID #{{ $client->id }}</span>
                </td>
                <td>
                  {{ $client->email ?: 'Aucun email' }}<br>
                  <span class="admin-subtitle">{{ $client->phone ?: 'Aucun telephone' }}</span>
                </td>
                <td>{{ trim(($client->city ? $client->city.' - ' : '').($client->address ?: 'Adresse non renseignee'), ' -') }}</td>
                <td>
                  <span class="badge {{ $client->is_active ? 'badge-active' : 'badge-inactive' }}">
                    {{ $client->is_active ? 'Actif' : 'Inactif' }}
                  </span>
                </td>
                <td>
                  <div class="actions">
                    <a class="btn btn-secondary" href="{{ route('admin.clients.edit', $client) }}">Modifier</a>

                    <form method="POST" action="{{ route('admin.clients.toggle', $client) }}">
                      @csrf
                      @method('PATCH')
                      <button class="btn {{ $client->is_active ? 'btn-warning' : 'btn-success' }}" type="submit">
                        {{ $client->is_active ? 'Desactiver' : 'Activer' }}
                      </button>
                    </form>

                    <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" onsubmit="return confirm('Supprimer ce client ?');">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" type="submit">Supprimer</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5">Aucun client pour le moment.</td>
              </tr>
            @endforelse
          </tbody>
        </table>

        <div style="margin-top:20px;">
          {{ $clients->links() }}
        </div>
      </div>
    </main>
  </div>
@endsection
