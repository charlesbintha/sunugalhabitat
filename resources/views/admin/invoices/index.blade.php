@extends('admin.layout')

@section('title', 'Factures')

@section('body')
  <div class="admin-shell">
    @include('admin.partials.sidebar')

    <main class="admin-content">
      <div class="admin-topbar">
        <div>
          <h1 class="admin-title">Factures</h1>
          <div class="admin-subtitle">Brouillon, validation, PDF et envoi email.</div>
        </div>
        <a href="{{ route('admin.invoices.create') }}" class="btn btn-primary">Nouvelle facture</a>
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
              <th>Facture</th>
              <th>Client</th>
              <th>Type</th>
              <th>Montant net</th>
              <th>Statut</th>
              <th>Envoi</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($invoices as $invoice)
              <tr>
                <td>
                  <strong>{{ $invoice->invoice_number }}</strong><br>
                  <span class="admin-subtitle">{{ $invoice->title }}</span>
                </td>
                <td>
                  {{ $invoice->client?->name }}<br>
                  <span class="admin-subtitle">{{ $invoice->client?->email ?: 'Aucun email' }}</span>
                </td>
                <td>
                  {{ $invoice->typeLabel() }}<br>
                  <span class="admin-subtitle">{{ $invoice->propertyKindLabel() }}</span>
                </td>
                <td>{{ number_format($invoice->totalAmount(), 0, ',', ' ') }} FCFA</td>
                <td>
                  <span class="badge {{ $invoice->isValidated() ? 'badge-active' : 'badge-inactive' }}">
                    {{ $invoice->statusLabel() }}
                  </span>
                </td>
                <td>{{ $invoice->sent_at ? $invoice->sent_at->format('d/m/Y H:i') : 'Non envoyee' }}</td>
                <td>
                  <div class="actions">
                    <a class="btn btn-secondary" href="{{ route('admin.invoices.show', $invoice) }}">Ouvrir</a>

                    @if ($invoice->canBeEdited())
                      <a class="btn btn-secondary" href="{{ route('admin.invoices.edit', $invoice) }}">Modifier</a>
                    @endif

                    <a class="btn btn-primary" href="{{ route('admin.invoices.pdf', $invoice) }}">PDF</a>

                    @if ($invoice->isDraft())
                      <form method="POST" action="{{ route('admin.invoices.destroy', $invoice) }}" onsubmit="return confirm('Supprimer cette facture brouillon ?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Supprimer</button>
                      </form>
                    @endif
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7">Aucune facture pour le moment.</td>
              </tr>
            @endforelse
          </tbody>
        </table>

        <div style="margin-top:20px;">
          {{ $invoices->links() }}
        </div>
      </div>
    </main>
  </div>
@endsection
