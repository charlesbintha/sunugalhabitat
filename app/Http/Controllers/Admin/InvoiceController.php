<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Models\Client;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Throwable;

class InvoiceController extends Controller
{
    public function index(): View
    {
        return view('admin.invoices.index', [
            'invoices' => Invoice::query()
                ->with('client')
                ->latestFirst()
                ->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.invoices.create', [
            'invoice' => new Invoice([
                'invoice_type' => Invoice::TYPE_SALE,
                'property_kind' => Invoice::PROPERTY_STANDARD,
                'issue_date' => now()->toDateString(),
                'discount_rate' => 0,
                'status' => Invoice::STATUS_DRAFT,
            ]),
            'clients' => $this->clientOptions(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $invoice = new Invoice([
            'invoice_number' => $this->nextInvoiceNumber(),
            'created_by' => $request->user()?->id,
            'status' => Invoice::STATUS_DRAFT,
        ]);

        $this->saveInvoice($invoice, $request);

        return redirect()
            ->route('admin.invoices.show', $invoice)
            ->with('status', 'Facture enregistree en brouillon.');
    }

    public function show(Invoice $invoice): View
    {
        $invoice->load('client', 'creator');

        return view('admin.invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice): View|RedirectResponse
    {
        if (! $invoice->canBeEdited()) {
            return redirect()
                ->route('admin.invoices.show', $invoice)
                ->withErrors(['status' => 'Cette facture validee ne peut pas etre modifiee.']);
        }

        return view('admin.invoices.edit', [
            'invoice' => $invoice,
            'clients' => $this->clientOptions($invoice->client_id),
        ]);
    }

    public function update(Request $request, Invoice $invoice): RedirectResponse
    {
        if (! $invoice->canBeEdited()) {
            return redirect()
                ->route('admin.invoices.show', $invoice)
                ->withErrors(['status' => 'Cette facture validee ne peut pas etre modifiee.']);
        }

        $this->saveInvoice($invoice, $request);

        return redirect()
            ->route('admin.invoices.show', $invoice)
            ->with('status', 'Facture brouillon mise a jour.');
    }

    public function validateInvoice(Invoice $invoice): RedirectResponse
    {
        if ($invoice->isValidated()) {
            return back()->withErrors(['status' => 'Cette facture est deja validee.']);
        }

        $invoice->update([
            'status' => Invoice::STATUS_VALIDATED,
            'validated_at' => now(),
        ]);

        return redirect()
            ->route('admin.invoices.show', $invoice)
            ->with('status', 'Facture validee. Elle est maintenant verrouillee.');
    }

    public function revertToDraft(Invoice $invoice): RedirectResponse
    {
        $invoice->update([
            'status' => Invoice::STATUS_DRAFT,
            'validated_at' => null,
        ]);

        return redirect()
            ->route('admin.invoices.show', $invoice)
            ->with('status', 'Facture remise en brouillon.');
    }

    public function send(Invoice $invoice): RedirectResponse
    {
        $invoice->load('client');

        if (! $invoice->isValidated()) {
            return back()->withErrors(['status' => 'Validez la facture avant envoi.']);
        }

        if (blank($invoice->client?->email)) {
            return back()->withErrors(['status' => 'Le client n a pas d adresse email.']);
        }

        try {
            Mail::to($invoice->client->email)->send(new InvoiceMail(
                $invoice,
                $this->pdfBinary($invoice),
                $invoice->pdfFilename(),
            ));
        } catch (Throwable $exception) {
            return back()->withErrors([
                'status' => 'Envoi impossible. Verifiez la configuration mail dans le .env.',
            ]);
        }

        $invoice->update([
            'sent_at' => now(),
        ]);

        return redirect()
            ->route('admin.invoices.show', $invoice)
            ->with('status', 'Facture envoyee au client par email.');
    }

    public function downloadPdf(Invoice $invoice): Response
    {
        return Pdf::loadView('admin.invoices.pdf', [
            'invoice' => $invoice->load('client', 'creator'),
        ])->setPaper('a4', 'portrait')->download($invoice->pdfFilename());
    }

    public function destroy(Invoice $invoice): RedirectResponse
    {
        if ($invoice->isValidated()) {
            return back()->withErrors([
                'status' => 'Supprimez uniquement les factures encore en brouillon.',
            ]);
        }

        $invoice->delete();

        return redirect()
            ->route('admin.invoices.index')
            ->with('status', 'Facture brouillon supprimee.');
    }

    protected function saveInvoice(Invoice $invoice, Request $request): void
    {
        $data = $request->validate([
            'client_id' => ['required', Rule::exists('clients', 'id')],
            'title' => ['required', 'string', 'max:255'],
            'invoice_type' => ['required', Rule::in([Invoice::TYPE_SALE, Invoice::TYPE_RENTAL])],
            'property_kind' => ['required', Rule::in([Invoice::PROPERTY_STANDARD, Invoice::PROPERTY_LAND])],
            'terrain_document_type' => ['nullable', Rule::in([Invoice::LAND_BAIL, Invoice::LAND_TF])],
            'amount' => ['required', 'numeric', 'min:0'],
            'discount_rate' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'issue_date' => ['required', 'date'],
            'due_date' => ['nullable', 'date', 'after_or_equal:issue_date'],
            'notes' => ['nullable', 'string'],
        ]);

        $data['is_deposit'] = $request->boolean('is_deposit');
        $data['apply_discount'] = $request->boolean('apply_discount');
        $data['discount_rate'] = (float) ($data['discount_rate'] ?? 0);
        $data['status'] = $invoice->status ?: Invoice::STATUS_DRAFT;

        if ($data['property_kind'] !== Invoice::PROPERTY_LAND) {
            $data['terrain_document_type'] = null;
        }

        $invoice->fill($data)->save();
    }

    protected function clientOptions(?int $selectedClientId = null)
    {
        return Client::query()
            ->where(function ($query) use ($selectedClientId) {
                $query->where('is_active', true);

                if ($selectedClientId) {
                    $query->orWhereKey($selectedClientId);
                }
            })
            ->orderBy('name')
            ->get();
    }

    protected function nextInvoiceNumber(): string
    {
        $prefix = 'FAC-'.now()->format('Ym').'-';
        $lastNumber = Invoice::query()
            ->where('invoice_number', 'like', $prefix.'%')
            ->orderByDesc('invoice_number')
            ->value('invoice_number');

        $sequence = 1;

        if ($lastNumber) {
            $sequence = ((int) substr($lastNumber, -4)) + 1;
        }

        return $prefix.str_pad((string) $sequence, 4, '0', STR_PAD_LEFT);
    }

    protected function pdfBinary(Invoice $invoice): string
    {
        return Pdf::loadView('admin.invoices.pdf', [
            'invoice' => $invoice->load('client', 'creator'),
        ])->setPaper('a4', 'portrait')->output();
    }
}
