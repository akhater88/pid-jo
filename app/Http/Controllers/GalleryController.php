<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Contracts\View\View;

class GalleryController extends Controller
{
    /**
     * Display the gallery page.
     */
    public function index(): View
    {
        $images = GalleryImage::query()
            ->published()
            ->ordered()
            ->get();

        return view('gallery.index', [
            'images' => $images,
        ]);
    }
}
