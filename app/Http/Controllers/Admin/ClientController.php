<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(): View
    {
        return view('admin.clients.index', [
            'clients' => Client::query()
                ->orderBy('name')
                ->orderBy('email')
                ->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.clients.create', [
            'client' => new Client([
                'is_active' => true,
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $client = new Client();
        $this->saveClient($client, $request);

        return redirect()
            ->route('admin.clients.index')
            ->with('status', 'Client ajoute avec succes.');
    }

    public function edit(Client $client): View
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client): RedirectResponse
    {
        $this->saveClient($client, $request);

        return redirect()
            ->route('admin.clients.index')
            ->with('status', 'Client mis a jour.');
    }

    public function toggle(Client $client): RedirectResponse
    {
        $client->update([
            'is_active' => ! $client->is_active,
        ]);

        return redirect()
            ->route('admin.clients.index')
            ->with('status', $client->is_active ? 'Client active.' : 'Client desactive.');
    }

    public function destroy(Client $client): RedirectResponse
    {
        if ($client->invoices()->exists()) {
            return back()->withErrors([
                'status' => 'Impossible de supprimer ce client car il a deja des factures.',
            ]);
        }

        $client->delete();

        return redirect()
            ->route('admin.clients.index')
            ->with('status', 'Client supprime.');
    }

    protected function saveClient(Client $client, Request $request): void
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        $client->fill($data)->save();
    }
}
