<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $invoice->invoice_number }}</title>
  <style>
    @page {
      size: A4 landscape;
      margin: 10mm 16mm 10mm 10mm;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      background: #fff;
      font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
      color: #050505;
    }
    .invoice {
      position: relative;
      width: 100%;
      min-height: auto;
      margin: 0;
      background: #fff;
      padding: 10mm 16mm 10mm 14mm;
      overflow: hidden;
    }
    .invoice:before {
      content: "";
      position: absolute;
      left: 0;
      top: 10mm;
      bottom: 0;
      width: 7mm;
      background: #d8b44a;
      border-top-right-radius: 6mm;
    }
    .corner-dot {
      position: absolute;
      left: -3mm;
      top: -3mm;
      width: 12mm;
      height: 12mm;
      border-radius: 50%;
      background: #f1d36c;
    }
    .header {
      width: 100%;
      margin-bottom: 10mm;
      table-layout: fixed;
    }
    .header td {
      vertical-align: top;
      width: 50%;
    }
    .brand h1 {
      margin: 0;
      font-size: 18px;
      letter-spacing: -1px;
      font-weight: 900;
      color: #0f2f57;
    }
    .brand p {
      margin: 4px 0 0 3px;
      font-size: 8px;
      letter-spacing: .8px;
      font-weight: 700;
      color: #5b5b5b;
    }
    .title {
      margin: 0;
      font-size: 18px;
      letter-spacing: 0;
      font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
      font-weight: 900;
      color: #0f2f57;
      text-align: left;
      white-space: nowrap;
    }
    .meta {
      width: 100%;
      font-size: 10px;
      font-weight: 900;
      border-bottom: 1px dashed #000;
      padding-bottom: 7px;
      margin-bottom: 6mm;
      table-layout: fixed;
    }
    .meta td {
      vertical-align: bottom;
    }
    .meta p {
      margin: 0 0 4px 0;
      line-height: 1.25;
    }
    .meta .right {
      text-align: left;
    }
    .parties {
      width: 100%;
      margin-bottom: 6mm;
      font-size: 9px;
      line-height: 1.35;
      font-weight: 700;
      table-layout: fixed;
    }
    .parties td {
      vertical-align: top;
      width: 50%;
    }
    .parties .recipient {
      text-align: left;
    }
    .party-title {
      margin: 0 0 8px 0;
      font-size: 10px;
      font-weight: 900;
      color: #0f2f57;
    }
    .party-text {
      margin: 0;
      word-break: break-word;
    }
    table.items {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 5mm;
      table-layout: fixed;
    }
    table.items th {
      text-align: left;
      font-size: 9px;
      padding: 0 0 8px 0;
      border-bottom: 2px solid #111;
    }
    table.items th:nth-child(1),
    table.items td:nth-child(1) {
      width: 46%;
    }
    table.items th:nth-child(2),
    table.items td:nth-child(2) {
      width: 24%;
    }
    table.items th:nth-child(3),
    table.items td:nth-child(3) {
      width: 10%;
    }
    table.items th:nth-child(4),
    table.items td:nth-child(4) {
      width: 20%;
    }
    table.items th:nth-child(2),
    table.items td:nth-child(2),
    table.items th:nth-child(3),
    table.items td:nth-child(3),
    table.items th:nth-child(4),
    table.items td:nth-child(4) {
      text-align: right;
    }
    table.items td {
      font-size: 9px;
      padding: 6px 0;
      border-bottom: 1px dotted #111;
      vertical-align: top;
      word-break: break-word;
    }
    .bottom {
      width: 100%;
      margin-bottom: 4mm;
      table-layout: fixed;
    }
    .bottom td {
      vertical-align: top;
    }
    .payment {
      width: 44%;
      padding-right: 10mm;
    }
    .totals {
      width: 56%;
      font-size: 10px;
      font-weight: 900;
    }
    .section-title {
      margin: 0 0 8px 0;
      font-size: 10px;
      font-weight: 900;
      color: #0f2f57;
    }
    .payment p,
    .terms p {
      margin: 0;
      font-size: 8px;
      line-height: 1.35;
    }
    .payment strong {
      font-size: 9px;
    }
    .totals-table {
      width: 100%;
      border-collapse: collapse;
    }
    .totals-table td {
      padding: 0 0 8px 0;
      font-size: 9px;
      font-weight: 900;
    }
    .totals-table td:first-child {
      text-align: right;
      padding-right: 16px;
    }
    .totals-table td:last-child {
      text-align: right;
      width: 28mm;
    }
    .terms {
      width: 100%;
      margin-top: 2mm;
    }
    .decor {
      position: absolute;
      right: 0;
      bottom: 0;
      width: 22mm;
      height: 22mm;
    }
    .bubble {
      position: absolute;
      border-radius: 50%;
    }
    .b1 { right: 82px; bottom: 126px; width: 21px; height: 21px; background: #ff914d; }
    .b2 { right: 94px; bottom: 82px; width: 29px; height: 29px; background: #f98bd1; }
    .b3 { right: 47px; bottom: 85px; width: 39px; height: 39px; background: #dfcfb7; }
    .b4 { right: 34px; bottom: 27px; width: 45px; height: 45px; background: #9fd0df; }
    .b5 { right: 114px; bottom: 48px; width: 22px; height: 22px; background: #eee; }
    .b6 { right: -23px; bottom: -30px; width: 73px; height: 73px; background: #f2eeee; }
    @media print {
      body { background: #fff; }
      .invoice { box-shadow: none; }
    }
  </style>
</head>
<body>
  <main class="invoice">
    <div class="corner-dot"></div>
    @php
      $invoiceDescriptor = collect([
          $invoice->typeLabel(),
          $invoice->propertyKindLabel(),
          $invoice->terrainDocumentLabel(),
          $invoice->is_deposit ? 'Acompte' : null,
      ])->filter()->implode(' - ');
    @endphp

    <table class="header">
      <tr>
        <td style="width:68%;">
          <div class="brand">
            <h1>SUNUGAL HABITAT</h1>
            <p>AGENCE IMMOBILIERE - DAKAR POINT E</p>
          </div>
        </td>
        <td style="width:32%;">
          <h2 class="title">FACTURE</h2>
        </td>
      </tr>
    </table>

    <table class="meta">
      <tr>
        <td>
          <p>DATE : {{ optional($invoice->issue_date)->format('d / m / Y') }}</p>
          <p>ECHEANCE : {{ $invoice->due_date ? $invoice->due_date->format('d / m / Y') : '-' }}</p>
        </td>
        <td class="right" style="padding-left:10mm;">
          <p>FACTURE N&deg; : {{ $invoice->invoice_number }}</p>
          <p>STATUT : {{ strtoupper($invoice->statusLabel()) }}</p>
        </td>
      </tr>
    </table>

    <table class="parties">
      <tr>
        <td>
          <h3 class="party-title">EMETTEUR :</h3>
          <p class="party-text">
            Sunugal Habitat<br>
            info@sunugalhabitat.sn<br>
            +221 76 199 19 08<br>
            Dakar Point E en face UCAD
          </p>
        </td>
        <td class="recipient" style="padding-left:10mm;">
          <h3 class="party-title">DESTINATAIRE :</h3>
          <p class="party-text">
            {{ strtoupper($invoice->client?->name ?? 'CLIENT') }}<br>
            {{ $invoice->client?->email ?: 'Email non renseigne' }}<br>
            {{ $invoice->client?->phone ?: 'Telephone non renseigne' }}<br>
            {{ trim(($invoice->client?->city ?: '').($invoice->client?->address ? ', '.$invoice->client->address : '')) ?: 'Adresse non renseignee' }}
          </p>
        </td>
      </tr>
    </table>

    <table class="items">
      <thead>
        <tr>
          <th>Description :</th>
          <th>Prix unitaire :</th>
          <th>Quantite :</th>
          <th>Total :</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            {{ $invoice->title }}<br>
            <span style="font-size:13px; color:#5b5b5b;">
              {{--
                Keep this line compact to avoid page overflow in landscape PDF.
              --}}
              {{ $invoiceDescriptor }}
            </span>
          </td>
          <td>{{ number_format($invoice->subtotalAmount(), 0, ',', ' ') }} FCFA</td>
          <td>1</td>
          <td>{{ number_format($invoice->subtotalAmount(), 0, ',', ' ') }} FCFA</td>
        </tr>
      </tbody>
    </table>

    <table class="bottom">
      <tr>
        <td class="payment">
          <h3 class="section-title">REGLEMENT :</h3>
          <p>
            <strong>Mode de paiement :</strong><br>
            A convenir avec Sunugal Habitat.<br><br>
            <strong>Notes :</strong><br>
            {{ $invoice->notes ?: 'Aucune note complementaire.' }}
          </p>
        </td>
        <td class="totals">
          <table class="totals-table">
            <tr>
              <td>TOTAL BRUT :</td>
              <td>{{ number_format($invoice->subtotalAmount(), 0, ',', ' ') }} FCFA</td>
            </tr>
            <tr>
              <td>REMISE {{ (float) $invoice->discount_rate > 0 ? rtrim(rtrim(number_format((float) $invoice->discount_rate, 2, '.', ''), '0'), '.').'%' : '' }} :</td>
              <td>{{ number_format($invoice->discountAmount(), 0, ',', ' ') }} FCFA</td>
            </tr>
            <tr>
              <td>TOTAL HT :</td>
              <td>{{ number_format($invoice->netBeforeVatAmount(), 0, ',', ' ') }} FCFA</td>
            </tr>
            <tr>
              <td>TVA 18% :</td>
              <td>{{ number_format($invoice->vatAmount(), 0, ',', ' ') }} FCFA</td>
            </tr>
            <tr>
              <td>TOTAL TTC :</td>
              <td>{{ number_format($invoice->totalAmount(), 0, ',', ' ') }} FCFA</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <div class="terms">
      <h3 class="section-title">TERMES & CONDITIONS</h3>
      <p>
        Merci de verifier les informations de cette facture des reception. Toute facture validee emise par
        Sunugal Habitat est reputee conforme sauf retour contraire dans un delai raisonnable. Pour toute question,
        contactez l'agence a info@sunugalhabitat.sn ou par WhatsApp au +221 76 199 19 08.
      </p>
    </div>

    <div class="decor">
      <span class="bubble b1"></span><span class="bubble b2"></span><span class="bubble b3"></span>
      <span class="bubble b4"></span><span class="bubble b5"></span><span class="bubble b6"></span>
    </div>
  </main>
</body>
</html>
