<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index(): View
    {
        return view('admin.admins.index', [
            'admins' => User::query()
                ->where('is_admin', true)
                ->orderBy('name')
                ->orderBy('email')
                ->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.admins.create', [
            'adminUser' => new User([
                'is_admin' => true,
                'is_active' => true,
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'is_admin' => true,
            'is_active' => $request->boolean('is_active', true),
            'email_verified_at' => now(),
        ]);

        return redirect()
            ->route('admin.admins.index')
            ->with('status', 'Compte admin ajoute avec succes.');
    }

    public function edit(User $adminUser): View
    {
        abort_unless($adminUser->is_admin, 404);

        return view('admin.admins.edit', compact('adminUser'));
    }

    public function update(Request $request, User $adminUser): RedirectResponse
    {
        abort_unless($adminUser->is_admin, 404);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($adminUser->id)],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $isActive = $request->boolean('is_active');

        if (! $isActive && $this->cannotDeactivate($adminUser, $request->user())) {
            return back()->withErrors([
                'is_active' => 'Impossible de desactiver ce compte admin.',
            ]);
        }

        $adminUser->name = $data['name'];
        $adminUser->email = $data['email'];
        $adminUser->is_admin = true;
        $adminUser->is_active = $isActive;

        if (! empty($data['password'])) {
            $adminUser->password = $data['password'];
        }

        $adminUser->save();

        return redirect()
            ->route('admin.admins.index')
            ->with('status', 'Compte admin mis a jour.');
    }

    public function toggle(Request $request, User $adminUser): RedirectResponse
    {
        abort_unless($adminUser->is_admin, 404);

        if ($this->cannotDeactivate($adminUser, $request->user(), ! $adminUser->is_active)) {
            return back()->withErrors([
                'status' => 'Impossible de desactiver ce compte admin.',
            ]);
        }

        $adminUser->update([
            'is_active' => ! $adminUser->is_active,
        ]);

        return redirect()
            ->route('admin.admins.index')
            ->with('status', $adminUser->is_active ? 'Compte admin active.' : 'Compte admin desactive.');
    }

    public function destroy(Request $request, User $adminUser): RedirectResponse
    {
        abort_unless($adminUser->is_admin, 404);

        if ($request->user()?->id === $adminUser->id) {
            return back()->withErrors([
                'status' => 'Vous ne pouvez pas supprimer votre propre compte admin.',
            ]);
        }

        if ($this->activeAdminCount() <= 1 && $adminUser->is_active) {
            return back()->withErrors([
                'status' => 'Impossible de supprimer le dernier admin actif.',
            ]);
        }

        $adminUser->delete();

        return redirect()
            ->route('admin.admins.index')
            ->with('status', 'Compte admin supprime.');
    }

    protected function cannotDeactivate(User $target, ?User $currentUser, bool $isActivating = false): bool
    {
        if ($isActivating) {
            return false;
        }

        if ($currentUser?->id === $target->id) {
            return true;
        }

        return $target->is_active && $this->activeAdminCount() <= 1;
    }

    protected function activeAdminCount(): int
    {
        return User::query()
            ->where('is_admin', true)
            ->where('is_active', true)
            ->count();
    }
}
