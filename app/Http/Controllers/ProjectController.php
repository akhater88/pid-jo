<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display the specified project.
     */
    public function show(string $serviceSlug, string $projectSlug): \Illuminate\View\View
    {
        $currentLocale = app()->getLocale();
        $fallbackLocale = 'en';

        // Try to find project by slug in current locale, fallback to English if not found
        $project = Project::query()
            ->with('service')
            ->where(function ($query) use ($currentLocale, $projectSlug, $fallbackLocale) {
                $query->where('slug->' . $currentLocale, $projectSlug)
                    ->orWhere('slug->' . $fallbackLocale, $projectSlug);
            })
            ->published()
            ->firstOrFail();

        // Verify the project belongs to the correct service (check all available translations)
        $serviceSlugEn = $project->service->getTranslation('slug', 'en', false);
        $serviceSlugAr = $project->service->getTranslation('slug', 'ar', false);

        // Accept if slug matches in either language
        if ($serviceSlugEn !== $serviceSlug && $serviceSlugAr !== $serviceSlug) {
            abort(404);
        }

        return view('projects.show', compact('project'));
    }
}
