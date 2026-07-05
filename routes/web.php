<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// Root redirect - detect locale and redirect
Route::get('/', [LanguageController::class, 'detect'])->name('root');

// Language switcher
Route::get('/locale/{locale}', [LanguageController::class, 'switch'])->name('locale.switch');

// Locale-prefixed routes - manually define for en and ar
foreach (['en', 'ar'] as $locale) {
    Route::prefix($locale)->middleware(['setLocaleFromUrl'])->group(function () use ($locale) {
        // Home
        Route::get('/', [PageController::class, 'home'])->name("home.{$locale}");

        // About
        Route::get('/about', [PageController::class, 'about'])->name("about.{$locale}");

        // Services
        Route::get('/services', [ServiceController::class, 'index'])->name("services.index.{$locale}");
        Route::get('/services/{slug}', [ServiceController::class, 'show'])->name("services.show.{$locale}");

        // Blog / News & Blogs
        Route::get('/blog', [BlogController::class, 'index'])->name("blog.index.{$locale}");
        Route::get('/blog/{slug}', [BlogController::class, 'show'])->name("blog.show.{$locale}");

        // Gallery
        Route::get('/gallery', [GalleryController::class, 'index'])->name("gallery.{$locale}");

        // Contact
        Route::get('/contact', [ContactController::class, 'index'])->name("contact.{$locale}");
        Route::post('/contact', [ContactController::class, 'store'])->name("contact.store.{$locale}");

        // FAQ
        Route::get('/faq', [PageController::class, 'faq'])->name("faq.{$locale}");

        // Legal Pages
        Route::get('/privacy-policy', [PageController::class, 'privacy'])->name("privacy.{$locale}");
        Route::get('/terms-conditions', [PageController::class, 'terms'])->name("terms.{$locale}");

        // Generic pages (page builder)
        Route::get('/page/{slug}', [PageController::class, 'show'])->name("page.show.{$locale}");
    });
}

// Set up the default route names to point to the current locale
Route::get('home', function () {
    return redirect('/' . app()->getLocale());
})->name('home');

Route::get('about', function () {
    return redirect('/' . app()->getLocale() . '/about');
})->name('about');

Route::get('services', function () {
    return redirect('/' . app()->getLocale() . '/services');
})->name('services.index');

Route::get('blog', function () {
    return redirect('/' . app()->getLocale() . '/blog');
})->name('blog.index');

Route::get('gallery', function () {
    return redirect('/' . app()->getLocale() . '/gallery');
})->name('gallery');

Route::get('contact', function () {
    return redirect('/' . app()->getLocale() . '/contact');
})->name('contact');

Route::get('faq', function () {
    return redirect('/' . app()->getLocale() . '/faq');
})->name('faq');

Route::get('privacy', function () {
    return redirect('/' . app()->getLocale() . '/privacy-policy');
})->name('privacy');

Route::get('terms', function () {
    return redirect('/' . app()->getLocale() . '/terms-conditions');
})->name('terms');
