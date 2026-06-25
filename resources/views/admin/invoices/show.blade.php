@extends('admin.layout')

@section('title', $invoice->invoice_number)

@section('body')
  <div class="admin-shell">
    @include('admin.partials.sidebar')

    <main class="admin-content">
      <div class="admin-topbar">
        <div>
          <h1 class="admin-title">{{ $invoice->invoice_number }}</h1>
          <div class="admin-subtitle">{{ $invoice->title }}</div>
        </div>

        <div class="actions">
          <a href="{{ route('admin.invoices.pdf', $invoice) }}" class="btn btn-primary">Telecharger le PDF</a>

          @if ($invoice->canBeEdited())
            <a href="{{ route('admin.invoices.edit', $invoice) }}" class="btn btn-secondary">Modifier</a>

            <form method="POST" action="{{ route('admin.invoices.validate', $invoice) }}">
              @csrf
              @method('PATCH')
              <button type="submit" class="btn btn-success">Valider</button>
            </form>
          @else
            <form method="POST" action="{{ route('admin.invoices.revert', $invoice) }}">
              @csrf
              @method('PATCH')
              <button type="submit" class="btn btn-warning">Remettre en brouillon</button>
            </form>

            <form method="POST" action="{{ route('admin.invoices.send', $invoice) }}">
              @csrf
              <button type="submit" class="btn btn-success">Envoyer au client</button>
            </form>
          @endif
        </div>
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

      <div class="panel-grid">
        <div class="metric-card">
          <div class="admin-subtitle">Statut</div>
          <strong>{{ $invoice->statusLabel() }}</strong>
        </div>
        <div class="metric-card">
          <div class="admin-subtitle">Montant net</div>
          <strong>{{ number_format($invoice->totalAmount(), 0, ',', ' ') }} FCFA</strong>
        </div>
        <div class="metric-card">
          <div class="admin-subtitle">Envoi</div>
          <strong style="font-size:18px;">{{ $invoice->sent_at ? $invoice->sent_at->format('d/m/Y H:i') : 'Pas encore envoye' }}</strong>
        </div>
      </div>

      <div class="stack">
        <div class="admin-panel">
          <h2 style="margin-top:0;">Informations facture</h2>
          <div class="info-list">
            <div class="info-row">
              <div class="info-label">Client</div>
              <div>{{ $invoice->client?->name }}{{ $invoice->client?->email ? ' - '.$invoice->client->email : '' }}</div>
            </div>
            <div class="info-row">
              <div class="info-label">Type</div>
              <div>{{ $invoice->typeLabel() }}</div>
            </div>
            <div class="info-row">
              <div class="info-label">Nature</div>
              <div>
                {{ $invoice->propertyKindLabel() }}
                @if ($invoice->terrainDocumentLabel())
                  - {{ $invoice->terrainDocumentLabel() }}
                @endif
              </div>
            </div>
            <div class="info-row">
              <div class="info-label">Date facture</div>
              <div>{{ optional($invoice->issue_date)->format('d/m/Y') }}</div>
            </div>
            <div class="info-row">
              <div class="info-label">Echeance</div>
              <div>{{ $invoice->due_date ? $invoice->due_date->format('d/m/Y') : 'Non renseignee' }}</div>
            </div>
            <div class="info-row">
              <div class="info-label">Acompte</div>
              <div>{{ $invoice->is_deposit ? 'Oui' : 'Non' }}</div>
            </div>
            <div class="info-row">
              <div class="info-label">Remise</div>
              <div>{{ (float) $invoice->discount_rate > 0 ? rtrim(rtrim(number_format((float) $invoice->discount_rate, 2, '.', ''), '0'), '.').'%' : 'Aucune' }}</div>
            </div>
            <div class="info-row">
              <div class="info-label">TVA</div>
              <div>{{ $invoice->apply_discount ? '18%' : 'Non appliquee' }}</div>
            </div>
            <div class="info-row">
              <div class="info-label">Cree par</div>
              <div>{{ $invoice->creator?->name ?: 'Administration' }}</div>
            </div>
          </div>
        </div>

        <div class="admin-panel">
          <h2 style="margin-top:0;">Montants</h2>
          <div class="info-list">
            <div class="info-row">
              <div class="info-label">Montant brut</div>
              <div>{{ number_format($invoice->subtotalAmount(), 0, ',', ' ') }} FCFA</div>
            </div>
            <div class="info-row">
              <div class="info-label">Remise</div>
              <div>{{ number_format($invoice->discountAmount(), 0, ',', ' ') }} FCFA</div>
            </div>
            <div class="info-row">
              <div class="info-label">Net avant TVA</div>
              <div>{{ number_format($invoice->netBeforeVatAmount(), 0, ',', ' ') }} FCFA</div>
            </div>
            <div class="info-row">
              <div class="info-label">TVA 18%</div>
              <div>{{ number_format($invoice->vatAmount(), 0, ',', ' ') }} FCFA</div>
            </div>
            <div class="info-row">
              <div class="info-label">Montant net</div>
              <div><strong>{{ number_format($invoice->totalAmount(), 0, ',', ' ') }} FCFA</strong></div>
            </div>
          </div>
        </div>

        <div class="admin-panel">
          <h2 style="margin-top:0;">Notes</h2>
          <div class="admin-subtitle" style="margin-top:0;">
            {{ $invoice->notes ?: 'Aucune note pour cette facture.' }}
          </div>
        </div>
      </div>
    </main>
  </div>
@endsection
