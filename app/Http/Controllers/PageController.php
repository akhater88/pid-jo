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
        return view('pages.home');
    }

    /**
     * Display the about us page.
     */
    public function about(): View
    {
        return view('pages.about');
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
        return view('pages.privacy');
    }

    /**
     * Display the terms and conditions page.
     */
    public function terms(): View
    {
        return view('pages.terms');
    }
}
