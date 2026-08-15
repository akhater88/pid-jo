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
        // Find project by slug in current locale
        $project = Project::query()
            ->with('service')
            ->where('slug->' . app()->getLocale(), $projectSlug)
            ->published()
            ->firstOrFail();

        // Verify the project belongs to the correct service
        if ($project->service->getTranslation('slug', app()->getLocale()) !== $serviceSlug) {
            abort(404);
        }

        return view('projects.show', compact('project'));
    }
}
