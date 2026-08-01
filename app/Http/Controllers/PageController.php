<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    /**
     * Display the homepage.
     */
    public function home(): View
    {
        $page = Page::find(1);

        if (!$page) {
            // Fallback to static home view if page ID 1 doesn't exist
            return view('pages.home');
        }

        return view('pages.show', [
            'page' => $page,
            'title' => $page->title,
            'seoTitle' => $page->seo_title ?? $page->title,
            'seoDescription' => $page->seo_description,
        ]);
    }

    /**
     * Display the about us page.
     */
    public function about(): View
    {
        $page = Page::query()
            ->where('slug->' . app()->getLocale(), 'about')
            ->published()
            ->firstOrFail();

        return view('pages.show', [
            'page' => $page,
            'title' => $page->title,
            'seoTitle' => $page->seo_title ?? $page->title,
            'seoDescription' => $page->seo_description,
        ]);
    }

    /**
     * Display the blog/news page.
     */
    public function blog(): View
    {
        $page = Page::query()
            ->where('slug->' . app()->getLocale(), 'blog')
            ->published()
            ->firstOrFail();

        return view('pages.show', [
            'page' => $page,
            'title' => $page->title,
            'seoTitle' => $page->seo_title ?? $page->title,
            'seoDescription' => $page->seo_description,
        ]);
    }

    /**
     * Display the services page.
     */
    public function services(): View
    {
        $page = Page::query()
            ->where('slug->' . app()->getLocale(), 'services')
            ->published()
            ->firstOrFail();

        return view('pages.show', [
            'page' => $page,
            'title' => $page->title,
            'seoTitle' => $page->seo_title ?? $page->title,
            'seoDescription' => $page->seo_description,
        ]);
    }

    /**
     * Display a generic page by slug.
     */
    public function show(string $slug): View
    {
        $page = Page::query()
            ->where('slug->' . app()->getLocale(), $slug)
            ->published()
            ->firstOrFail();

        return view('pages.show', [
            'page' => $page,
            'title' => $page->title,
            'seoTitle' => $page->seo_title ?? $page->title,
            'seoDescription' => $page->seo_description,
        ]);
    }

    /**
     * Display the FAQ page.
     */
    public function faq(): View
    {
        $faqs = \App\Models\Faq::query()
            ->published()
            ->ordered()
            ->get();

        return view('pages.faq', [
            'faqs' => $faqs,
        ]);
    }

    /**
     * Display the privacy policy page.
     */
    public function privacy(): View
    {
        $settings = app(\App\Settings\LegalSettings::class);

        return view('pages.privacy', [
            'title' => $settings->privacy_title[app()->getLocale()],
            'content' => $settings->privacy_content[app()->getLocale()],
        ]);
    }

    /**
     * Display the terms and conditions page.
     */
    public function terms(): View
    {
        $settings = app(\App\Settings\LegalSettings::class);

        return view('pages.terms', [
            'title' => $settings->terms_title[app()->getLocale()],
            'content' => $settings->terms_content[app()->getLocale()],
        ]);
    }
}
