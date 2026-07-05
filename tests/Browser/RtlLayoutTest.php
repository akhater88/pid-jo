<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RtlLayoutTest extends DuskTestCase
{
    /**
     * Test that English page renders with LTR direction.
     */
    public function test_renders_ltr_for_en(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/en')
                ->assertAttribute('html', 'lang', 'en')
                ->assertAttribute('html', 'dir', 'ltr')
                ->assertSee('PESARO')
                ->assertSee('Crafted interiors, coming soon.');
        });
    }

    /**
     * Test that Arabic page renders with RTL direction.
     */
    public function test_renders_rtl_for_ar(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ar')
                ->assertAttribute('html', 'lang', 'ar')
                ->assertAttribute('html', 'dir', 'rtl')
                ->assertSee('بيسارو')
                ->assertSee('تصاميم داخلية مصنوعة بإتقان، قريباً.');
        });
    }

    /**
     * Test that language switcher changes locale via header link.
     */
    public function test_switches_language_via_header_link(): void
    {
        $this->browse(function (Browser $browser) {
            // Start on English page
            $browser->visit('/en')
                ->assertSee('PESARO')
                ->assertAttribute('html', 'dir', 'ltr')
                // Click Arabic language switcher
                ->clickLink('العربية')
                ->waitForLocation('/ar')
                ->assertAttribute('html', 'lang', 'ar')
                ->assertAttribute('html', 'dir', 'rtl')
                ->assertSee('بيسارو')
                // Switch back to English
                ->clickLink('English')
                ->waitForLocation('/en')
                ->assertAttribute('html', 'lang', 'en')
                ->assertAttribute('html', 'dir', 'ltr')
                ->assertSee('PESARO');
        });
    }

    /**
     * Test that language choice persists via cookie.
     */
    public function test_persists_language_choice_via_cookie(): void
    {
        $this->browse(function (Browser $browser) {
            // Visit Arabic page - should set cookie
            $browser->visit('/ar')
                ->assertSee('بيسارو')
                // Visit root - should redirect to Arabic based on cookie
                ->visit('/')
                ->waitForLocation('/ar')
                ->assertAttribute('html', 'lang', 'ar')
                ->assertAttribute('html', 'dir', 'rtl')
                ->assertSee('بيسارو');

            // Clear cookies and visit root again
            $browser->deleteCookie('pesaro_locale')
                ->visit('/')
                ->pause(500) // Wait for redirect
                ->assertPathIs('/en')
                ->assertAttribute('html', 'lang', 'en')
                ->assertAttribute('html', 'dir', 'ltr')
                ->assertSee('PESARO');
        });
    }

    /**
     * Test that fonts switch correctly based on direction.
     */
    public function test_fonts_switch_based_on_direction(): void
    {
        $this->browse(function (Browser $browser) {
            // English page should use Inter font
            $browser->visit('/en')
                ->assertScript('
                    const fontFamily = getComputedStyle(document.body).fontFamily;
                    return fontFamily.includes("Inter");
                ', true);

            // Arabic page should use IBM Plex Sans Arabic font
            $browser->visit('/ar')
                ->assertScript('
                    const fontFamily = getComputedStyle(document.body).fontFamily;
                    return fontFamily.includes("IBM Plex Sans Arabic");
                ', true);
        });
    }

    /**
     * Test that skip-to-content link is accessible.
     */
    public function test_skip_to_content_link_accessible(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/en')
                // Tab to focus on skip link
                ->keys('body', '{tab}')
                ->assertPresent('a[href="#main-content"]')
                ->assertSeeIn('a[href="#main-content"]', 'Skip to content');
        });
    }
}
