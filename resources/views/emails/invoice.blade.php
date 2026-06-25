<p>Bonjour {{ $invoice->client?->name }},</p>

<p>Veuillez trouver en piece jointe votre facture <strong>{{ $invoice->invoice_number }}</strong> emise par Sunugal Habitat.</p>

<p>Objet: {{ $invoice->title }}<br>
Montant net: {{ number_format($invoice->totalAmount(), 0, ',', ' ') }} FCFA</p>

<p>Pour toute question, vous pouvez repondre a cet email ou nous contacter directement.</p>

<p>Sunugal Habitat<br>
Enracines dans la confiance</p>
