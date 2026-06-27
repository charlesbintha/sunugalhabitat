<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>{{ $invoice->invoice_number }}</title>
<style>
@page {
  size: A4 portrait;
  margin: 0;
}

* {
  box-sizing: border-box;
}

body {
  margin: 0;
  background: #eef3f8;
  font-family: DejaVu Sans, Arial, sans-serif;
  color: #1f2937;
}

.invoice {
  width: 210mm;
  min-height: 297mm;
  margin: 0 auto;
  background: #ffffff;
  padding: 22mm;
  position: relative;
  overflow: hidden;
}

.invoice::before {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  width: 88mm;
  height: 88mm;
  background: linear-gradient(135deg, #0f2f57, #1c4f8c);
  border-bottom-left-radius: 100%;
  opacity: .98;
}

.header {
  position: relative;
  width: 100%;
  z-index: 2;
}

.header td {
  vertical-align: top;
}

.brand-wrap {
  width: 60%;
}

.brand-mark {
  margin-bottom: 12px;
}

.brand-mark img {
  width: 92px;
  height: auto;
  display: block;
}

.brand h1 {
  margin: 0;
  font-size: 26px;
  color: #0f2f57;
  letter-spacing: .5px;
}

.brand p {
  margin: 6px 0 0;
  font-size: 12px;
  color: #64748b;
  line-height: 1.6;
}

.invoice-title {
  width: 40%;
  text-align: right;
  color: #fff;
}

.invoice-title h2 {
  margin: 0;
  font-size: 34px;
  letter-spacing: 2px;
}

.invoice-title span {
  display: inline-block;
  margin-top: 8px;
  font-size: 13px;
  background: rgba(255,255,255,.18);
  padding: 6px 12px;
  border-radius: 20px;
}

.info-grid {
  width: 100%;
  margin-top: 38px;
}

.info-grid td {
  width: 50%;
  vertical-align: top;
}

.card {
  border: 1px solid #d9e5f4;
  border-radius: 16px;
  padding: 18px;
  background: #f8fbff;
}

.card.left {
  margin-right: 9px;
}

.card.right {
  margin-left: 9px;
}

.card h3 {
  margin: 0 0 12px;
  font-size: 13px;
  color: #0f2f57;
  text-transform: uppercase;
  letter-spacing: .8px;
}

.card p {
  margin: 4px 0;
  font-size: 13px;
  line-height: 1.6;
}

.meta {
  margin-top: 24px;
  width: 100%;
  border-radius: 14px;
  overflow: hidden;
  border: 1px solid #d9e5f4;
}

.meta td {
  width: 25%;
  padding: 13px;
  background: #f2f7fd;
  border-right: 1px solid #d9e5f4;
  vertical-align: top;
}

.meta td:last-child {
  border-right: none;
}

.meta small {
  display: block;
  font-size: 10px;
  color: #64748b;
  text-transform: uppercase;
  margin-bottom: 5px;
}

.meta strong {
  font-size: 13px;
  color: #0f2f57;
}

table.items {
  width: 100%;
  border-collapse: collapse;
  margin-top: 30px;
}

table.items thead {
  background: #0f2f57;
  color: #fff;
}

table.items th {
  padding: 14px 12px;
  font-size: 12px;
  text-align: left;
  text-transform: uppercase;
}

table.items td {
  padding: 14px 12px;
  font-size: 13px;
  border-bottom: 1px solid #e5e7eb;
  vertical-align: top;
}

table.items tbody tr:nth-child(even) {
  background: #f8fbff;
}

.text-right {
  text-align: right;
}

.badge {
  display: inline-block;
  padding: 5px 10px;
  background: #e8eef8;
  color: #0f2f57;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 700;
}

.summary {
  margin-top: 28px;
  width: 100%;
}

.summary td {
  vertical-align: top;
}

.notes {
  width: 55%;
  background: #f8fbff;
  border-left: 5px solid #d8b44a;
  padding: 16px;
  border-radius: 12px;
  margin-right: 14px;
}

.notes h3 {
  margin: 0 0 8px;
  color: #0f2f57;
  font-size: 13px;
}

.notes p {
  margin: 0;
  font-size: 12px;
  line-height: 1.7;
  color: #475569;
}

.totals {
  width: 38%;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid #e7dcc0;
  margin-left: 14px;
}

.totals-row {
  width: 100%;
}

.totals-row td {
  padding: 13px 16px;
  font-size: 13px;
  border-bottom: 1px solid #e5e7eb;
}

.totals-row td:last-child {
  text-align: right;
}

.totals-final td {
  background: #0f2f57;
  color: #fff;
  font-size: 18px;
  font-weight: 800;
  border-bottom: none;
}

.payment {
  margin-top: 28px;
  padding: 18px;
  border-radius: 16px;
  background: linear-gradient(135deg, #f8fbff, #fff8ea);
  border: 1px solid #e7dcc0;
}

.payment h3 {
  margin: 0 0 10px;
  color: #0f2f57;
  font-size: 14px;
}

.payment-grid {
  width: 100%;
}

.payment-grid td {
  width: 33.33%;
  vertical-align: top;
  padding-right: 14px;
}

.payment-grid p {
  margin: 0;
  font-size: 12px;
  color: #475569;
  line-height: 1.6;
}

.payment-grid strong {
  display: block;
  color: #111827;
  margin-top: 4px;
}

.footer {
  margin-top: 26px;
  width: 100%;
  font-size: 11px;
  color: #64748b;
  border-top: 1px solid #e5e7eb;
  padding-top: 12px;
}

.footer td {
  vertical-align: bottom;
}

.signature {
  text-align: right;
}

.signature span {
  display: inline-block;
  margin-top: 35px;
  border-top: 1px solid #94a3b8;
  padding-top: 6px;
  color: #334155;
  min-width: 140px;
  text-align: center;
}

@media print {
  body {
    background: #fff;
  }

  .invoice {
    margin: 0;
    box-shadow: none;
  }
}
</style>
</head>
<body>
@php
  $logoPath = public_path('img/logo/sunugal-logo.png');
  $logoDataUri = file_exists($logoPath)
      ? 'data:image/png;base64,'.base64_encode(file_get_contents($logoPath))
      : null;

  $statusLabel = $invoice->isValidated() ? 'Validee' : 'Brouillon';
  $propertyReference = $invoice->invoice_number;
  $propertyTypeLabel = trim(collect([
      $invoice->typeLabel(),
      $invoice->propertyKindLabel(),
      $invoice->terrainDocumentLabel(),
      $invoice->is_deposit ? 'Acompte' : null,
  ])->filter()->implode(' - '));
@endphp

<div class="invoice">
  <table class="header">
    <tr>
      <td class="brand-wrap">
        <div class="brand-mark">
          @if ($logoDataUri)
            <img src="{{ $logoDataUri }}" alt="Sunugal Habitat">
          @endif
        </div>
        <div class="brand">
          <h1>SUNUGAL HABITAT</h1>
          <p>
            Agence immobiliere & gestion locative<br>
            Dakar, Senegal<br>
            Tel : +221 76 199 19 08<br>
            Email : info@sunugalhabitat.sn
          </p>
        </div>
      </td>

      <td class="invoice-title">
        <h2>FACTURE</h2>
        <span>N° {{ $invoice->invoice_number }}</span>
      </td>
    </tr>
  </table>

  <table class="info-grid">
    <tr>
      <td>
        <div class="card left">
          <h3>Facture a</h3>
          <p><strong>{{ $invoice->client?->name ?: 'Client' }}</strong></p>
          <p>Adresse : {{ trim(($invoice->client?->city ?: '').($invoice->client?->address ? ', '.$invoice->client->address : '')) ?: 'Non renseignee' }}</p>
          <p>Telephone : {{ $invoice->client?->phone ?: 'Non renseigne' }}</p>
          <p>Email : {{ $invoice->client?->email ?: 'Non renseigne' }}</p>
        </div>
      </td>
      <td>
        <div class="card right">
          <h3>Bien immobilier</h3>
          <p><strong>{{ $invoice->title }}</strong></p>
          <p>Localisation : {{ $invoice->client?->city ?: 'Dakar' }}</p>
          <p>Reference : {{ $propertyReference }}</p>
          <p>Type : {{ $propertyTypeLabel ?: 'Facture immobiliere' }}</p>
        </div>
      </td>
    </tr>
  </table>

  <table class="meta">
    <tr>
      <td>
        <small>Date facture</small>
        <strong>{{ optional($invoice->issue_date)->format('d/m/Y') }}</strong>
      </td>
      <td>
        <small>Date echeance</small>
        <strong>{{ $invoice->due_date ? $invoice->due_date->format('d/m/Y') : '-' }}</strong>
      </td>
      <td>
        <small>Mode paiement</small>
        <strong>A convenir</strong>
      </td>
      <td>
        <small>Statut</small>
        <strong>{{ $statusLabel }}</strong>
      </td>
    </tr>
  </table>

  <table class="items">
    <thead>
      <tr>
        <th>Description</th>
        <th>Type</th>
        <th class="text-right">Qte</th>
        <th class="text-right">Prix unitaire</th>
        <th class="text-right">Total</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{ $invoice->title }}</td>
        <td><span class="badge">{{ $invoice->typeLabel() }}</span></td>
        <td class="text-right">1</td>
        <td class="text-right">{{ number_format($invoice->subtotalAmount(), 0, ',', ' ') }} FCFA</td>
        <td class="text-right">{{ number_format($invoice->subtotalAmount(), 0, ',', ' ') }} FCFA</td>
      </tr>
    </tbody>
  </table>

  <table class="summary">
    <tr>
      <td style="width:58%;">
        <div class="notes">
          <h3>Notes</h3>
          <p>
            {{ $invoice->notes ?: 'Merci de proceder au reglement avant la date d echeance indiquee. Cette facture concerne uniquement les prestations mentionnees ci-dessus.' }}
          </p>
        </div>
      </td>
      <td style="width:42%;">
        <div class="totals">
          <table class="totals-row">
            <tr>
              <td>Sous-total</td>
              <td>{{ number_format($invoice->subtotalAmount(), 0, ',', ' ') }} FCFA</td>
            </tr>
            <tr>
              <td>Remise {{ (float) $invoice->discount_rate > 0 ? rtrim(rtrim(number_format((float) $invoice->discount_rate, 2, '.', ''), '0'), '.').'%' : '' }}</td>
              <td>{{ number_format($invoice->discountAmount(), 0, ',', ' ') }} FCFA</td>
            </tr>
            <tr>
              <td>TVA 18%</td>
              <td>{{ number_format($invoice->vatAmount(), 0, ',', ' ') }} FCFA</td>
            </tr>
            <tr class="totals-final">
              <td>Total TTC</td>
              <td>{{ number_format($invoice->totalAmount(), 0, ',', ' ') }} FCFA</td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
  </table>

  <div class="payment">
    <h3>Informations de paiement</h3>
    <table class="payment-grid">
      <tr>
        <td>
          <p>Mode de paiement<strong>A convenir avec Sunugal Habitat</strong></p>
        </td>
        <td>
          <p>Nature de facture<strong>{{ $propertyTypeLabel ?: 'Facture immobiliere' }}</strong></p>
        </td>
        <td>
          <p>Net avant TVA<strong>{{ number_format($invoice->netBeforeVatAmount(), 0, ',', ' ') }} FCFA</strong></p>
        </td>
      </tr>
    </table>
  </div>

  <table class="footer">
    <tr>
      <td>
        Merci de verifier les informations de cette facture des reception. Pour toute question,
        contactez l'agence a info@sunugalhabitat.sn ou par WhatsApp au +221 76 199 19 08.
      </td>
      <td class="signature">
        <span>Sunugal Habitat</span>
      </td>
    </tr>
  </table>
</div>
</body>
</html>
