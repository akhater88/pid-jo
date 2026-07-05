<?php

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Support\Facades\Hash;

test('admin user can be created with super admin role', function () {
    // Create admin user directly (simulating what seeder does)
    $admin = User::create([
        'name' => 'Test Admin',
        'email' => 'testadmin@test.com',
        'password' => Hash::make('testpassword123'),
        'role' => 'super_admin',
        'email_verified_at' => now(),
    ]);

    // Refresh the model to get database values
    $admin->refresh();

    // Assert user was created correctly
    expect($admin)->not->toBeNull()
        ->and($admin->name)->toBe('Test Admin')
        ->and($admin->email)->toBe('testadmin@test.com')
        ->and($admin->role)->toBe('super_admin')
        ->and($admin->email_verified_at)->not->toBeNull()
        ->and(Hash::check('testpassword123', $admin->password))->toBeTrue();
});

test('admin user seeder throws exception when password is missing', function () {
    // Clear password environment variable
    putenv('ADMIN_PASSWORD=');

    // Run the seeder and expect exception
    $seeder = new AdminUserSeeder();

    expect(fn () => $seeder->run())
        ->toThrow(\RuntimeException::class, 'ADMIN_PASSWORD environment variable is required');
});

test('admin user seeder skips if admin already exists', function () {
    // Create an existing admin
    User::factory()->superAdmin()->create([
        'email' => 'existing@test.com',
    ]);

    // Set environment to try creating same admin
    putenv('ADMIN_EMAIL=existing@test.com');
    putenv('ADMIN_PASSWORD=testpassword123');

    // Run the seeder
    $seeder = new AdminUserSeeder();
    $seeder->run();

    // Assert only one admin exists with this email
    $adminCount = User::where('email', 'existing@test.com')->count();
    expect($adminCount)->toBe(1);
});

test('user factory creates editor by default', function () {
    $user = User::factory()->create();

    expect($user->role)->toBe('editor')
        ->and($user->isEditor())->toBeTrue()
        ->and($user->isSuperAdmin())->toBeFalse();
});

test('user factory can create super admin', function () {
    $user = User::factory()->superAdmin()->create();

    expect($user->role)->toBe('super_admin')
        ->and($user->isSuperAdmin())->toBeTrue()
        ->and($user->isEditor())->toBeFalse();
});

test('user can access panel returns correct result', function () {
    $superAdmin = User::factory()->superAdmin()->create();
    $editor = User::factory()->editor()->create();
    $panel = app(\Filament\Facades\Filament::class)::getCurrentPanel();

    expect($superAdmin->canAccessPanel($panel))->toBeTrue()
        ->and($editor->canAccessPanel($panel))->toBeTrue();
});
