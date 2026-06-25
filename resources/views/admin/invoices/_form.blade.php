@csrf

<div class="stack">
  <div class="admin-panel">
    <div class="grid-2">
      <div class="field">
        <label for="client_id">Client</label>
        <select id="client_id" name="client_id" required>
          <option value="">Choisir un client</option>
          @foreach ($clients as $clientOption)
            <option value="{{ $clientOption->id }}" @selected(old('client_id', $invoice->client_id) == $clientOption->id)>
              {{ $clientOption->name }}{{ $clientOption->email ? ' - '.$clientOption->email : '' }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="field">
        <label for="title">Objet de la facture</label>
        <input id="title" type="text" name="title" value="{{ old('title', $invoice->title) }}" placeholder="Ex: Commission de location appartement Point E" required>
      </div>

      <div class="field">
        <label for="invoice_type">Type de facture</label>
        <select id="invoice_type" name="invoice_type" required>
          <option value="vente" @selected(old('invoice_type', $invoice->invoice_type) === 'vente')>Vente</option>
          <option value="location" @selected(old('invoice_type', $invoice->invoice_type) === 'location')>Location</option>
        </select>
      </div>

      <div class="field">
        <label for="property_kind">Nature du bien</label>
        <select id="property_kind" name="property_kind" required>
          <option value="bien" @selected(old('property_kind', $invoice->property_kind) === 'bien')>Bien immobilier</option>
          <option value="terrain" @selected(old('property_kind', $invoice->property_kind) === 'terrain')>Terrain</option>
        </select>
      </div>

      <div class="field" id="terrain-document-field">
        <label for="terrain_document_type">Document terrain</label>
        <select id="terrain_document_type" name="terrain_document_type">
          <option value="">Aucun</option>
          <option value="bail" @selected(old('terrain_document_type', $invoice->terrain_document_type) === 'bail')>Bail</option>
          <option value="tf" @selected(old('terrain_document_type', $invoice->terrain_document_type) === 'tf')>TF</option>
        </select>
        <div class="hint">A renseigner uniquement si la facture concerne un terrain.</div>
      </div>

      <div class="field">
        <label for="amount">Montant (FCFA)</label>
        <input id="amount" type="number" step="0.01" min="0" name="amount" value="{{ old('amount', $invoice->amount) }}" placeholder="Ex: 250000" required>
      </div>

      <div class="field">
        <label for="issue_date">Date de facture</label>
        <input id="issue_date" type="date" name="issue_date" value="{{ old('issue_date', optional($invoice->issue_date)->format('Y-m-d') ?: $invoice->issue_date) }}" required>
      </div>

      <div class="field">
        <label for="due_date">Date d echeance</label>
        <input id="due_date" type="date" name="due_date" value="{{ old('due_date', optional($invoice->due_date)->format('Y-m-d') ?: $invoice->due_date) }}">
      </div>
    </div>

    <div class="field">
      <label for="notes">Notes</label>
      <textarea id="notes" name="notes" placeholder="Ex: Conditions de paiement, precision sur l acompte, rappel du dossier...">{{ old('notes', $invoice->notes) }}</textarea>
    </div>

    <div class="grid-2">
      <div class="field" style="margin-bottom:0;">
        <label for="discount_rate">Remise (%)</label>
        <input id="discount_rate" type="number" step="0.01" min="0" max="100" name="discount_rate" value="{{ old('discount_rate', $invoice->discount_rate) }}" placeholder="Ex: 10">
        <div class="hint">Laissez 0 si aucune remise n est appliquee.</div>
      </div>

      <label class="checkbox">
        <input type="checkbox" name="is_deposit" value="1" {{ old('is_deposit', $invoice->is_deposit) ? 'checked' : '' }}>
        <span>Facture d acompte</span>
      </label>
    </div>

    <div class="grid-2">
      <label class="checkbox" style="margin-top:0;">
        <input type="checkbox" name="apply_discount" value="1" {{ old('apply_discount', $invoice->apply_discount) ? 'checked' : '' }}>
        <span>Ajouter la TVA de 18%</span>
      </label>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
      <a href="{{ $cancelRoute }}" class="btn btn-secondary">Annuler</a>
    </div>
  </div>
</div>
