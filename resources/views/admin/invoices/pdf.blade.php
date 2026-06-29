<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>{{ $invoice->invoice_number }}</title>
<style>
@page {
  size: 210mm 297mm;
  margin: 8mm 9mm 5mm;
}

* {
  box-sizing: border-box;
}

body {
  margin: 0;
  background: #ffffff;
  font-family: DejaVu Sans, Arial, sans-serif;
  color: #1f2937;
  font-size: 11px;
}

.invoice {
  width: 100%;
  margin: 0 auto;
  background: #ffffff;
  padding: 0;
  position: relative;
  overflow: hidden;
}

.invoice::before {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  width: 52mm;
  height: 52mm;
  background: linear-gradient(135deg, #0f2f57, #1c4f8c);
  border-bottom-left-radius: 100%;
  opacity: .98;
}

.header {
  position: relative;
  width: 100%;
  z-index: 2;
  text-align: center;
}

.brand-mark {
  margin: 0 auto 6px;
  text-align: center;
}

.brand-mark img {
  width: 64px;
  height: auto;
  display: inline-block;
}

.brand h1 {
  margin: 0;
  font-size: 20px;
  color: #0f2f57;
  letter-spacing: .4px;
}

.brand-contact {
  margin: 6px auto 0;
  max-width: 150mm;
  font-size: 10px;
  color: #64748b;
  line-height: 1.5;
}

.invoice-heading {
  margin-top: 10px;
  text-align: center;
}

.invoice-heading h2 {
  margin: 0;
  font-size: 20px;
  letter-spacing: 1.2px;
  color: #0f2f57;
}

.invoice-heading span {
  display: inline-block;
  margin-top: 6px;
  font-size: 10px;
  background: #eef4fb;
  color: #0f2f57;
  padding: 5px 10px;
  border-radius: 16px;
  font-weight: 700;
}

.info-grid {
  width: 100%;
  margin-top: 14px;
}

.info-grid td {
  width: 50%;
  vertical-align: top;
}

.card {
  border: 1px solid #d9e5f4;
  border-radius: 14px;
  padding: 12px;
  background: #f8fbff;
}

.card.left {
  margin-right: 9px;
}

.card.right {
  margin-left: 9px;
}

.card h3 {
  margin: 0 0 8px;
  font-size: 11px;
  color: #0f2f57;
  text-transform: uppercase;
  letter-spacing: .8px;
}

.card p {
  margin: 4px 0;
  font-size: 11px;
  line-height: 1.35;
  word-break: break-word;
}

.meta {
  margin-top: 10px;
  width: 100%;
  border-radius: 12px;
  overflow: hidden;
  border: 1px solid #d9e5f4;
}

.meta td {
  width: 33.33%;
  padding: 9px;
  background: #f2f7fd;
  border-right: 1px solid #d9e5f4;
  vertical-align: top;
}

.meta td:last-child {
  border-right: none;
}

.meta small {
  display: block;
  font-size: 8px;
  color: #64748b;
  text-transform: uppercase;
  margin-bottom: 4px;
}

.meta strong {
  font-size: 11px;
  color: #0f2f57;
}

table.items {
  width: 100%;
  border-collapse: collapse;
  table-layout: fixed;
  margin-top: 12px;
}

table.items thead {
  background: #0f2f57;
  color: #fff;
}

table.items th {
  padding: 9px 7px;
  font-size: 9px;
  text-align: left;
  text-transform: uppercase;
}

table.items td {
  padding: 9px 7px;
  font-size: 10px;
  border-bottom: 1px solid #e5e7eb;
  vertical-align: top;
  word-break: break-word;
}

table.items tbody tr:nth-child(even) {
  background: #f8fbff;
}

.text-right {
  text-align: right;
}

.badge {
  display: inline-block;
  padding: 4px 8px;
  background: #e8eef8;
  color: #0f2f57;
  border-radius: 16px;
  font-size: 9px;
  font-weight: 700;
}

.summary {
  margin-top: 10px;
  width: 100%;
}

.notes {
  width: 100%;
  background: #f8fbff;
  border-left: 5px solid #d8b44a;
  padding: 8px 12px;
  border-radius: 12px;
  margin-top: 8px;
  page-break-inside: avoid;
}

.notes h3 {
  margin: 0 0 4px;
  color: #0f2f57;
  font-size: 11px;
}

.notes p {
  margin: 0;
  font-size: 10px;
  line-height: 1.35;
  color: #475569;
}

.totals {
  width: 100%;
  border-radius: 14px;
  overflow: hidden;
  border: 1px solid #e7dcc0;
  margin: 0;
  page-break-inside: avoid;
}

.totals-row {
  width: 100%;
}

.totals-row td {
  padding: 8px 12px;
  font-size: 10px;
  border-bottom: 1px solid #e5e7eb;
}

.totals-row td:last-child {
  text-align: right;
}

.totals-final td {
  background: #0f2f57;
  color: #fff;
  font-size: 13px;
  font-weight: 800;
  border-bottom: none;
}

.payment {
  display: none;
}

.footer {
  margin-top: 0;
  width: 100%;
  font-size: 9px;
  color: #64748b;
  border-top: 1px solid #e5e7eb;
  padding-top: 8px;
  page-break-inside: avoid;
}

.footer td {
  vertical-align: top;
}

.footer-copy {
  line-height: 1.35;
  text-align: center;
}

.legal-line {
  margin-top: 6px;
  font-size: 8.6px;
  line-height: 1.35;
  color: #475569;
  text-align: center;
}

.footer-spacer {
  height: 29mm;
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
  $companyNinea = '013165685';
  $companyRc = 'SN.DKR.2026.B.23723';

  $propertyReference = $invoice->invoice_number;
  $propertyTypeLabel = trim(collect([
      $invoice->typeLabel(),
      $invoice->propertyKindLabel(),
      $invoice->terrainDocumentLabel(),
      $invoice->is_deposit ? 'Acompte' : null,
  ])->filter()->implode(' - '));
@endphp

<div class="invoice">
  <div class="header">
    <div class="brand-mark">
      @if ($logoDataUri)
        <img src="{{ $logoDataUri }}" alt="Sunugal Habitat">
      @endif
    </div>
    <div class="brand">
      <h1>SUNUGAL HABITAT</h1>
      <div class="brand-contact">
        Agence immobiliere & gestion locative - Dakar, Senegal<br>
        Mobile : +221 76 199 19 08 - Fixe : +221 33 818 42 02 - info@sunugalhabitat.sn
      </div>
    </div>
    <div class="invoice-heading">
      <h2>FACTURE</h2>
      <span>N° {{ $invoice->invoice_number }}</span>
    </div>
  </div>

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
        <small>Nature</small>
        <strong>{{ $propertyTypeLabel ?: 'Facture immobiliere' }}</strong>
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

  <div class="summary">
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

    <div class="notes">
      <h3>Notes</h3>
      <p>
        {{ $invoice->notes ?: 'Merci de proceder au reglement avant la date d echeance indiquee. Cette facture concerne uniquement les prestations mentionnees ci-dessus.' }}
      </p>
    </div>
  </div>

  <div class="footer-spacer"></div>

  <table class="footer">
    <tr>
      <td class="footer-copy">
        Merci de verifier les informations de cette facture des reception. Pour toute question, contactez l'agence a info@sunugalhabitat.sn, au +221 76 199 19 08 ou au +221 33 818 42 02.
        <div class="legal-line">
          NINEA : {{ $companyNinea }} | RCCM : {{ $companyRc }} | Adresse : ZAC MBAO, Cite Soleil, Villa N°40, Dakar - Senegal
        </div>
      </td>
    </tr>
  </table>
</div>
</body>
</html>
