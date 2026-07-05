<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Creates a super_admin user based on .env credentials.
     * If ADMIN_PASSWORD is not set, throws an exception.
     */
    public function run(): void
    {
        // Note: Using env() in seeder is acceptable for one-time setup
        $email = env('ADMIN_EMAIL', 'admin@pid-jo.com');
        $password = env('ADMIN_PASSWORD');
        $name = env('ADMIN_NAME', 'Pesaro Admin');

        if (empty($password)) {
            throw new \RuntimeException(
                'ADMIN_PASSWORD environment variable is required for seeding. ' .
                'Please set it in your .env file before running the seeder.'
            );
        }

        // Check if admin already exists
        $existingAdmin = User::where('email', $email)->first();

        if ($existingAdmin !== null) {
            if ($this->command !== null) {
                $this->command->info("Admin user with email {$email} already exists. Skipping.");
            }

            return;
        }

        // Create super admin user
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'super_admin',
            'email_verified_at' => now(),
        ]);

        if ($this->command !== null) {
            $this->command->info("Super admin user created successfully: {$email}");
        }
    }
}
