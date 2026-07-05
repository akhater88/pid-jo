<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminAuthTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test that admin login page is accessible.
     */
    public function test_admin_login_page_accessible(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                ->assertSee('Sign in')
                ->assertPresent('input[type="email"]')
                ->assertPresent('input[type="password"]')
                ->assertPresent('button[type="submit"]');
        });
    }

    /**
     * Test that super admin can login successfully.
     */
    public function test_super_admin_can_login(): void
    {
        $admin = User::factory()->superAdmin()->create([
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),
        ]);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->visit('/admin/login')
                ->type('email', $admin->email)
                ->type('password', 'password123')
                ->press('Sign in')
                ->waitForLocation('/admin')
                ->assertPathIs('/admin')
                ->assertAuthenticated();
        });
    }

    /**
     * Test that editor can login successfully.
     */
    public function test_editor_can_login(): void
    {
        $editor = User::factory()->editor()->create([
            'email' => 'editor@test.com',
            'password' => bcrypt('password123'),
        ]);

        $this->browse(function (Browser $browser) use ($editor) {
            $browser->visit('/admin/login')
                ->type('email', $editor->email)
                ->type('password', 'password123')
                ->press('Sign in')
                ->waitForLocation('/admin')
                ->assertPathIs('/admin')
                ->assertAuthenticated();
        });
    }

    /**
     * Test that login fails with invalid credentials.
     */
    public function test_login_fails_with_invalid_credentials(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                ->type('email', 'nonexistent@test.com')
                ->type('password', 'wrongpassword')
                ->press('Sign in')
                ->pause(1000)
                ->assertPathIs('/admin/login')
                ->assertSee('credentials');
        });
    }

    /**
     * Test that unauthenticated users are redirected to login.
     */
    public function test_unauthenticated_redirected_to_login(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                ->waitForLocation('/admin/login')
                ->assertPathIs('/admin/login')
                ->assertGuest();
        });
    }

    /**
     * Test that admin can logout.
     */
    public function test_admin_can_logout(): void
    {
        $admin = User::factory()->superAdmin()->create([
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),
        ]);

        $this->browse(function (Browser $browser) use ($admin) {
            // Login first
            $browser->visit('/admin/login')
                ->type('email', $admin->email)
                ->type('password', 'password123')
                ->press('Sign in')
                ->waitForLocation('/admin')
                ->assertAuthenticated();

            // Find and click the user menu, then logout
            $browser->click('[x-data*="userMenu"]')
                ->pause(500)
                ->clickLink('Sign out')
                ->waitForLocation('/admin/login')
                ->assertPathIs('/admin/login')
                ->assertGuest();
        });
    }

    /**
     * Test login throttling after multiple failed attempts.
     */
    public function test_login_throttling_after_failed_attempts(): void
    {
        $this->browse(function (Browser $browser) {
            // Attempt to login with wrong credentials 5 times
            for ($i = 0; $i < 5; $i++) {
                $browser->visit('/admin/login')
                    ->type('email', 'attacker@test.com')
                    ->type('password', 'wrongpassword')
                    ->press('Sign in')
                    ->pause(500);
            }

            // 6th attempt should be throttled
            $browser->visit('/admin/login')
                ->type('email', 'attacker@test.com')
                ->type('password', 'wrongpassword')
                ->press('Sign in')
                ->pause(1000)
                ->assertSee('Too many');
        });
    }

    /**
     * Test that canAccessPanel method works correctly.
     */
    public function test_user_can_access_panel_method(): void
    {
        $superAdmin = User::factory()->superAdmin()->create();
        $editor = User::factory()->editor()->create();

        $panel = app(\Filament\Facades\Filament::class)::getCurrentPanel();

        $this->assertTrue($superAdmin->canAccessPanel($panel));
        $this->assertTrue($editor->canAccessPanel($panel));
    }
}
