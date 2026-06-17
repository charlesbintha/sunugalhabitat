<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:create {name} {email} {password}', function (string $name, string $email, string $password) {
    $existing = User::query()->where('email', $email)->first();

    if ($existing) {
        DB::table('users')
            ->where('id', $existing->id)
            ->update([
                'name' => $name,
                'password' => Hash::make($password),
                'is_admin' => 1,
                'is_active' => 1,
                'email_verified_at' => now(),
                'updated_at' => now(),
            ]);

        $user = User::query()->findOrFail($existing->id);
    } else {
        $user = User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'is_admin' => true,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
    }

    $this->info("Admin pret: {$user->email}");
})->purpose('Create or update an admin user');
