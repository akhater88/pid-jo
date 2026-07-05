<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LanguageController extends Controller
{
    /**
     * Detect locale from Accept-Language header or cookie and redirect.
     */
    public function detect(Request $request): RedirectResponse
    {
        // 1. Check for locale cookie first
        $cookieLocale = $request->cookie('pesaro_locale');
        if ($cookieLocale && in_array($cookieLocale, ['en', 'ar'])) {
            return redirect('/' . $cookieLocale);
        }

        // 2. Parse Accept-Language header
        $acceptLanguage = $request->header('Accept-Language');
        $preferredLocale = $this->parseAcceptLanguage($acceptLanguage);

        // 3. Default to 'en' if no match
        $locale = $preferredLocale ?: 'en';

        return redirect('/' . $locale);
    }

    /**
     * Switch language and redirect back.
     */
    public function switch(string $locale, Request $request): RedirectResponse
    {
        // Validate locale
        if (! in_array($locale, ['en', 'ar'])) {
            abort(404);
        }

        // Determine return URL - rewrite locale prefix
        $referer = $request->header('referer');
        $returnUrl = $this->rewriteLocaleInUrl($referer, $locale);

        // Set cookie for 1 year
        $cookie = Cookie::make(
            'pesaro_locale',
            $locale,
            60 * 24 * 365, // 1 year in minutes
            '/',
            null,
            config('app.env') === 'production', // secure in production
            false, // httpOnly = false so JS can read it
            false,
            'Lax'
        );

        return redirect($returnUrl)->cookie($cookie);
    }

    /**
     * Parse Accept-Language header and return best match.
     */
    private function parseAcceptLanguage(?string $acceptLanguage): ?string
    {
        if (! $acceptLanguage) {
            return null;
        }

        // Parse Accept-Language header
        // Example: "ar,en-US;q=0.9,en;q=0.8"
        $languages = [];
        foreach (explode(',', $acceptLanguage) as $lang) {
            $parts = explode(';q=', trim($lang));
            $code = strtolower(explode('-', $parts[0])[0]); // Get base language code
            $quality = isset($parts[1]) ? (float) $parts[1] : 1.0;
            $languages[$code] = $quality;
        }

        // Sort by quality descending
        arsort($languages);

        // Find first supported locale
        $supported = ['en', 'ar'];
        foreach (array_keys($languages) as $lang) {
            if (in_array($lang, $supported)) {
                return $lang;
            }
        }

        return null;
    }

    /**
     * Rewrite locale prefix in URL.
     */
    private function rewriteLocaleInUrl(?string $url, string $newLocale): string
    {
        if (! $url) {
            return '/' . $newLocale;
        }

        // Parse URL and replace locale segment
        $parsedUrl = parse_url($url);
        $path = $parsedUrl['path'] ?? '/';

        // Match /en/* or /ar/*
        if (preg_match('#^/(en|ar)(/.*)?$#', $path, $matches)) {
            $remainingPath = $matches[2] ?? '';

            return '/' . $newLocale . $remainingPath;
        }

        // If no locale in path, prepend it
        return '/' . $newLocale . $path;
    }
}
