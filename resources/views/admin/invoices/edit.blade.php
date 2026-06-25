@extends('admin.layout')

@section('title', 'Modifier la facture')

@section('body')
  <div class="admin-shell">
    @include('admin.partials.sidebar')

    <main class="admin-content">
      <div class="admin-topbar">
        <div>
          <h1 class="admin-title">Modifier la facture</h1>
          <div class="admin-subtitle">{{ $invoice->invoice_number }}</div>
        </div>
      </div>

      @if ($errors->any())
        <div class="errors">
          @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      <form method="POST" action="{{ route('admin.invoices.update', $invoice) }}">
        @csrf
        @method('PUT')
        @include('admin.invoices._form', [
          'submitLabel' => 'Mettre a jour le brouillon',
          'cancelRoute' => route('admin.invoices.show', $invoice),
        ])
      </form>
    </main>
  </div>

  @include('admin.invoices._form-scripts')
@endsection
