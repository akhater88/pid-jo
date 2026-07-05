# Pesaro Website — CLAUDE.md

This file is the persistent project memory for Claude Code agents working on the Pesaro Website. Read it at the start of every Wave. Conventions defined here override Claude's own defaults.

---

## Project Overview

- **Purpose:** Bilingual (English / Arabic with RTL) marketing website for **Pesaro**, an interior design company based in Amman, Jordan (Khalda, Rawan Mall). The site is managed end-to-end by the client through a Filament 3 admin panel with a block-based page builder.
- **Architecture:** Server-rendered Laravel monolith. No SPA, no public REST API, no microservices.
- **Audience:** General visitors browsing for interior design services. No public user accounts.
- **Admin audience:** Pesaro's content team. Non-technical. Filament admin with WYSIWYG, drag-and-drop builder, media library.

---

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 11 (PHP 8.2+) |
| Admin Panel | Filament 3 |
| Frontend | Blade templates + Tailwind CSS 3.4+ + Alpine.js 3 |
| Build | Vite (Laravel default) |
| Database | MySQL 8 |
| ORM | Eloquent |
| Cache / Queue | Redis (preferred) or Database driver fallback |
| Mail | Pending client decision — driver-agnostic; uses `Mail::send()` via config |
| Testing (unit/feature) | Pest (built on PHPUnit) |
| Testing (browser/E2E) | Laravel Dusk |
| Static analysis | Larastan (PHPStan for Laravel) at level 6 |
| Formatter | Laravel Pint (PSR-12) |
| Source control | Git + GitHub (main branch protected) |
| CI | GitHub Actions (Pest + Pint + Larastan) |
| Deploy | Laravel Forge auto-deploy from `main` |

### Required Composer packages

```
filament/filament:^3.2
spatie/laravel-translatable:^6.0
spatie/laravel-medialibrary:^11.0
mcamara/laravel-localization:^2.0
filament/spatie-laravel-settings-plugin:^3.0
filament/spatie-laravel-translatable-plugin:^3.0
spatie/laravel-sluggable:^3.0
spatie/laravel-sitemap:^7.0
```

### Required dev packages

```
pestphp/pest:^3.0
pestphp/pest-plugin-laravel:^3.0
laravel/dusk:^8.0
larastan/larastan:^3.0
laravel/pint:^1.0
```

---

## Folder Structure

```
app/
├── Filament/
│   ├── Resources/        # CRUD resources (Service, BlogPost, Testimonial, Faq, GalleryImage, Page, FormSubmission)
│   ├── Pages/            # Custom Filament pages (Site Settings)
│   ├── Blocks/           # Page builder block classes (extends Filament Builder Block)
│   └── Widgets/          # Dashboard widgets if any
├── Http/
│   ├── Controllers/
│   │   ├── PageController.php       # Generic page renderer
│   │   ├── ServiceController.php
│   │   ├── BlogController.php
│   │   ├── GalleryController.php
│   │   ├── ContactController.php
│   │   └── CommentController.php
│   ├── Middleware/
│   └── Requests/         # Form Request classes for validation
├── Models/
│   ├── Page.php
│   ├── Service.php
│   ├── BlogPost.php
│   ├── Comment.php
│   ├── Testimonial.php
│   ├── Faq.php
│   ├── FormSubmission.php
│   └── GalleryImage.php
├── Settings/
│   └── SiteSettings.php  # spatie/laravel-settings singleton
├── View/
│   └── Composers/        # Layout-wide data injection (nav, footer)
└── Services/             # Business logic where it doesn't belong in models

resources/
├── views/
│   ├── layouts/
│   │   ├── app.blade.php             # Master layout (lang/dir aware)
│   │   ├── partials/
│   │   │   ├── header.blade.php
│   │   │   ├── footer.blade.php
│   │   │   └── language-switcher.blade.php
│   ├── pages/                        # Generic page renderer + special pages
│   ├── blocks/                       # ONE Blade partial per page-builder block
│   │   ├── hero-home.blade.php
│   │   ├── hero-inner.blade.php
│   │   ├── section-heading.blade.php
│   │   ├── about-benefits.blade.php
│   │   ├── services-grid.blade.php
│   │   ├── news-grid.blade.php
│   │   ├── testimonials-carousel.blade.php
│   │   ├── timeline.blade.php
│   │   ├── service-detail-gallery.blade.php
│   │   ├── rich-text.blade.php
│   │   └── form-block.blade.php
│   ├── components/                   # Reusable Blade components (button, card, lightbox)
│   ├── services/                     # Service detail & index
│   ├── blog/                         # Blog index + detail
│   ├── gallery/                      # Gallery page
│   ├── contact/                      # Contact page
│   ├── legal/                        # Privacy & Terms
│   ├── faqs/                         # FAQ page
│   └── errors/                       # 404, 500
├── css/
│   └── app.css                       # Tailwind entry
├── js/
│   ├── app.js                        # Alpine + lightbox + carousel
│   └── lightbox.js
└── lang/
    ├── en/
    └── ar/

database/
├── migrations/
├── factories/
└── seeders/
    └── DatabaseSeeder.php

tests/
├── Feature/
├── Browser/              # Laravel Dusk
└── Unit/

config/
└── filament-pesaro.php   # Project-specific config (block defaults, etc.)
```

---

## Code Conventions

### Naming

- **Classes / Models:** `PascalCase` (`BlogPost`, `Service`, `GalleryImage`)
- **Methods / variables:** `camelCase` (`getPublishedAt()`, `$heroImage`)
- **Database tables:** `snake_case` plural (`blog_posts`, `gallery_images`)
- **Database columns:** `snake_case` (`hero_image_path`, `published_at`)
- **Route names:** `dot.case` (`services.show`, `blog.index`, `gallery.index`)
- **Blade files:** `kebab-case` (`hero-home.blade.php`, `service-card.blade.php`)
- **Filament Block keys:** `kebab-case` (`hero-home`, `services-grid`)
- **Tailwind custom classes:** avoid; use utilities. If unavoidable, prefix with `pesaro-` (`pesaro-scribble-underline`)

### Translatable attributes

Always declare translatable attributes as `array` casts and add the `spatie/laravel-translatable` `HasTranslations` trait. Migrations create a single `json` column per translatable attribute, NOT separate `title_en` / `title_ar` columns.

```php
// app/Models/Service.php
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasTranslations;

    public array $translatable = ['title', 'slug', 'short_description', 'body'];

    protected $casts = [
        'title' => 'array',
        'slug' => 'array',
        'short_description' => 'array',
        'body' => 'array',
        'published_at' => 'datetime',
    ];
}
```

```php
// Migration
Schema::create('services', function (Blueprint $table) {
    $table->id();
    $table->json('title');             // {"en": "Kitchens", "ar": "المطابخ"}
    $table->json('slug');              // {"en": "kitchens", "ar": "المطابخ"}
    $table->json('short_description')->nullable();
    $table->json('body')->nullable();
    $table->timestamp('published_at')->nullable();
    $table->unsignedInteger('sort_order')->default(0);
    $table->timestamps();
});
```

### Routing

All public routes are locale-prefixed via `mcamara/laravel-localization`. Use `LaravelLocalization::transRoute()` in views, never hardcode `/en/` or `/ar/`. The Page model's `slug` column is itself translatable so the slug differs per locale.

```php
// routes/web.php
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect'],
], function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get(LaravelLocalization::transRoute('routes.services'), [ServiceController::class, 'index'])->name('services.index');
    Route::get(LaravelLocalization::transRoute('routes.services-show'), [ServiceController::class, 'show'])->name('services.show');
    // ...
});
```

### RTL Handling

- Set `<html lang="{{ app()->getLocale() }}" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">` in `app.blade.php`.
- Use Tailwind logical properties whenever possible: `ms-` (margin-start), `me-` (margin-end), `ps-`, `pe-`, `start-`, `end-`, `text-start`, `text-end`.
- For everything else, pair `ml-` with `rtl:mr-` and `ml-0`, etc.
- Mirrored icons (arrows, chevrons) use `rtl:rotate-180` or swap the icon entirely.
- Fonts: bind `--font-body` to a CSS variable that swaps between `Inter` (LTR) and `IBM Plex Sans Arabic` (RTL) in the layout root.

### Media

All file uploads go through `spatie/laravel-medialibrary`. Never store raw file paths. Define media collections + conversions in each model:

```php
public function registerMediaCollections(): void
{
    $this->addMediaCollection('hero')->singleFile();
    $this->addMediaCollection('gallery');
}

public function registerMediaConversions(?Media $media = null): void
{
    $this->addMediaConversion('thumb')->width(400)->format('webp');
    $this->addMediaConversion('card')->width(800)->format('webp');
    $this->addMediaConversion('hero')->width(1920)->format('webp');
}
```

Render with `$model->getFirstMediaUrl('hero', 'hero')` (collection, then conversion).

### Validation

Use Form Request classes (`app/Http/Requests/`). Never validate in controllers inline. Provide localized error messages by setting `messages()` and `attributes()` on the request, with translation keys pointing to `resources/lang/{en,ar}/validation.php`.

### Forms / CSRF

All public forms include `@csrf`. Honeypot field is named `pesaro_field` and must be empty; bots filling it get a silent 200 redirect (do NOT show validation error).

---

## Page Builder Architecture

The `Page` model has a translatable `blocks` JSON column. Each page is an ordered array of block instances, each with a `type` (block key) and a `data` payload. Filament's `Builder` field renders each block type as its own form schema; the public site iterates the array and `@include`s the matching partial.

### Critical bilingual rule

The `blocks` column is itself translatable. **EN and AR for the same page can have entirely different block arrays.** When rendering, never assume the AR version has the same shape as EN. Always read from the current locale's blocks array.

```php
// app/Models/Page.php
public array $translatable = ['title', 'slug', 'blocks', 'seo_title', 'seo_description'];

protected $casts = [
    'title' => 'array',
    'slug' => 'array',
    'blocks' => 'array',
    'seo_title' => 'array',
    'seo_description' => 'array',
    'published_at' => 'datetime',
];

public function getRenderedBlocks(): array
{
    return $this->getTranslation('blocks', app()->getLocale(), false) ?? [];
}
```

### Block partial rendering

```blade
{{-- resources/views/pages/render.blade.php --}}
@foreach($page->getRenderedBlocks() as $block)
    @includeIf("blocks.{$block['type']}", ['data' => $block['data']])
@endforeach
```

If a block partial is missing, fail silently in production (skip the block) but throw in `local`/`testing`.

---

## Database Conventions

- Every translatable model has a `published_at` (nullable timestamp) for draft/publish state. Scope: `published()` returns `whereNotNull('published_at')->where('published_at', '<=', now())`.
- Every CRUD model has `sort_order` (unsigned integer, default 0) for manual ordering in admin.
- Soft deletes ONLY on `FormSubmission` and `Comment` (audit trail). Other models hard delete.
- Foreign keys: `cascadeOnDelete()` when child is meaningless without parent (e.g., comments cascade with blog post deletion).

---

## Testing Standards

- **Coverage target:** >80% on new code per Quality Gate.
- **Bilingual test rule:** Every public route test must iterate `['en', 'ar']` via a Pest dataset. A test that only covers one locale is incomplete.
- **Test file location:** `tests/Feature/` mirrors `app/Http/Controllers/` structure.
- **Naming:** `it('renders home page in {locale}')` not `test_home_page_works()`.
- **Factories:** every model has a `Factory` in `database/factories/` producing valid translatable data (both locales filled).
- **Dusk tests:** required for admin flows (login → create page → add blocks → save → see on frontend) and any flow involving JavaScript (lightbox, carousel, language switcher).
- **Pattern:** Arrange / Act / Assert. One assertion concept per test.

### Locale dataset example

```php
// tests/Pest.php
dataset('locales', ['en', 'ar']);

// tests/Feature/HomePageTest.php
it('renders home page in {locale}', function (string $locale) {
    $response = $this->get("/{$locale}");
    $response->assertOk();
    $response->assertSee("dir=\"" . ($locale === 'ar' ? 'rtl' : 'ltr') . "\"", false);
})->with('locales');
```

---

## What Claude Code MUST NEVER Do

- **Never** hardcode locale strings in routes or views. Use `route()` and `__()` / `@lang()`.
- **Never** create separate columns for translations (`title_en`, `title_ar`). Always use a single JSON column with spatie/laravel-translatable.
- **Never** assume EN and AR Page block arrays match. Read each independently.
- **Never** use `ml-*` / `mr-*` without RTL handling. Prefer `ms-*` / `me-*`.
- **Never** commit migrations that drop columns containing translated data without an explicit backup migration step.
- **Never** skip Pest tests for "trivial" routes. Bilingual coverage is mandatory.
- **Never** store user-uploaded files outside `storage/app/public/media`. Always via medialibrary.
- **Never** expose form submissions, admin emails, or phone numbers in compiled JS or public HTML beyond what's needed for display.
- **Never** add tracked changes, debug output, or `dd()` / `dump()` to committed code.
- **Never** generate code with `TODO`, `FIXME`, or placeholder logic. Spec is complete; implement it.

---

## Quality Gate Self-Check (before declaring a Wave complete)

| Check | Pass criteria |
|---|---|
| Pest tests pass | `php artisan test` exits 0 |
| Bilingual coverage | Every public route tested in both `en` and `ar` |
| Larastan passes | `vendor/bin/phpstan analyse` exits 0 at level 6 |
| Pint clean | `vendor/bin/pint --test` exits 0 |
| No `dd`/`dump`/`var_dump` | `grep -rn "dd(\|dump(\|var_dump(" app/ resources/` empty |
| No leftover placeholders | `grep -rn "TODO\|FIXME\|XXX" app/ resources/ database/` empty |
| Coverage report | New code ≥80% covered |
| Admin can perform the new action | Manual or Dusk check |
| RTL visually correct | Open `/ar/...` and visually verify mirroring |

---

## Wave Execution Protocol (the loop you follow)

For each Wave-Ready Package handed to you:

1. **Read** the WRP entirely. If anything is ambiguous, surface a Clarifying Questions Gate to the Agent Orchestrator before writing code.
2. **Output a Wave Execution Checklist** — break the WRP into 3-7 implementation units of ≤4 hours each.
3. **Implement ONE unit at a time.** After each unit:
   - Mark it complete in the checklist.
   - Write/update tests in the same Wave.
   - Output a Step Completion Report listing files changed + tests added.
   - Wait for "continue" before next unit.
4. **Run Quality Gate self-check** at the end of the WRP.
5. **Propose a CLAUDE.md update** (Recent Learnings) for anything non-obvious learned during the Wave.

---

## Project-Specific Patterns

### Locale-aware slug lookup

```php
// Find a service by its slug in the current locale
$service = Service::query()
    ->where("slug->" . app()->getLocale(), $slug)
    ->published()
    ->firstOrFail();
```

### Auto-breadcrumb for Inner Page Hero block

The Inner Page Hero block does NOT take a breadcrumb input. The Blade partial computes it from the current route + page hierarchy:

```php
// app/View/Composers/BreadcrumbComposer.php
// Resolves "Home > Services > False ceiling" automatically based on current Route::current()
```

### Footer 3×3 Gallery

The footer pulls 9 most-recent `GalleryImage` records where `show_in_footer = true`, ordered by `sort_order` then `created_at desc`. Rendered via a View Composer on `layouts.partials.footer`.

### Cache invalidation

Use `Cache::tags(['public-pages'])->remember(...)`. Any model save on Page, Service, BlogPost, Testimonial, Faq, GalleryImage, or SiteSettings triggers `Cache::tags(['public-pages'])->flush()` via a model observer.

---

## Recent Learnings

_(Updated after each Wave. Most recent on top. Keep last 15.)_

- _none yet — pre-Wave-01_

---
