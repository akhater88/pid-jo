<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceDetailTemplate;
use Illuminate\Contracts\View\View;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index(): View
    {
        $services = Service::query()
            ->published()
            ->ordered()
            ->get();

        return view('services.index', [
            'services' => $services,
        ]);
    }

    /**
     * Display the specified service.
     */
    public function show(string $slug): View
    {
        $currentLocale = app()->getLocale();
        $fallbackLocale = 'en';

        // Try to find service by slug in current locale, fallback to English if not found
        $service = Service::query()
            ->where(function ($query) use ($currentLocale, $slug, $fallbackLocale) {
                $query->where('slug->' . $currentLocale, $slug)
                    ->orWhere('slug->' . $fallbackLocale, $slug);
            })
            ->published()
            ->firstOrFail();

        $template = ServiceDetailTemplate::getActive();

        return view('services.show', [
            'service' => $service,
            'template' => $template,
            'title' => $service->title,
            'seoTitle' => $service->title,
            'seoDescription' => $service->short_description,
        ]);
    }
}
