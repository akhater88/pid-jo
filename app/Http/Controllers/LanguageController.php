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

        // Determine return URL - translate route with proper slugs
        $referer = $request->header('referer');
        $returnUrl = $this->translateRouteUrl($referer, $locale);

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
     * Translate URL to target locale with proper slug translation.
     */
    private function translateRouteUrl(?string $url, string $targetLocale): string
    {
        if (! $url) {
            return '/' . $targetLocale;
        }

        // Parse URL
        $parsedUrl = parse_url($url);
        $path = $parsedUrl['path'] ?? '/';

        // Extract current locale and path
        if (! preg_match('#^/(en|ar)(/.*)?$#', $path, $matches)) {
            return '/' . $targetLocale . $path;
        }

        $currentLocale = $matches[1];
        $remainingPath = $matches[2] ?? '';

        // If already in target locale, return as-is
        if ($currentLocale === $targetLocale) {
            return $path;
        }

        // Try to translate specific routes
        $translatedPath = $this->translatePathSlugs($remainingPath, $currentLocale, $targetLocale);

        return '/' . $targetLocale . $translatedPath;
    }

    /**
     * Translate slug parameters in path.
     */
    private function translatePathSlugs(string $path, string $fromLocale, string $toLocale): string
    {
        // Project route: /services/{serviceSlug}/projects/{projectSlug}
        if (preg_match('#^/services/([^/]+)/projects/([^/]+)#', $path, $matches)) {
            $serviceSlug = $matches[1];
            $projectSlug = $matches[2];

            $service = \App\Models\Service::query()
                ->where(function ($q) use ($serviceSlug, $fromLocale) {
                    $q->where('slug->' . $fromLocale, $serviceSlug)
                        ->orWhere('slug->en', $serviceSlug);
                })
                ->published()
                ->first();

            $project = \App\Models\Project::query()
                ->where(function ($q) use ($projectSlug, $fromLocale) {
                    $q->where('slug->' . $fromLocale, $projectSlug)
                        ->orWhere('slug->en', $projectSlug);
                })
                ->published()
                ->first();

            if ($service && $project) {
                $newServiceSlug = $service->getTranslation('slug', $toLocale, false) ?: $service->getTranslation('slug', 'en');
                $newProjectSlug = $project->getTranslation('slug', $toLocale, false) ?: $project->getTranslation('slug', 'en');

                return '/services/' . $newServiceSlug . '/projects/' . $newProjectSlug;
            }
        }

        // Service route: /services/{slug}
        if (preg_match('#^/services/([^/]+)$#', $path, $matches)) {
            $slug = $matches[1];

            $service = \App\Models\Service::query()
                ->where(function ($q) use ($slug, $fromLocale) {
                    $q->where('slug->' . $fromLocale, $slug)
                        ->orWhere('slug->en', $slug);
                })
                ->published()
                ->first();

            if ($service) {
                $newSlug = $service->getTranslation('slug', $toLocale, false) ?: $service->getTranslation('slug', 'en');

                return '/services/' . $newSlug;
            }
        }

        // Blog route: /blog/{slug}
        if (preg_match('#^/blog/([^/]+)$#', $path, $matches)) {
            $slug = $matches[1];

            $post = \App\Models\BlogPost::query()
                ->where(function ($q) use ($slug, $fromLocale) {
                    $q->where('slug->' . $fromLocale, $slug)
                        ->orWhere('slug->en', $slug);
                })
                ->published()
                ->first();

            if ($post) {
                $newSlug = $post->getTranslation('slug', $toLocale, false) ?: $post->getTranslation('slug', 'en');

                return '/blog/' . $newSlug;
            }
        }

        // Default: return path as-is
        return $path;
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
}
