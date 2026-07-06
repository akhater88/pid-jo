<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gallery images distribution for each service
        $serviceGalleries = [
            // Service 1: Kitchen Design - 5 images
            1 => ['service-gallery-1.png', 'service-gallery-2.png', 'service-gallery-3.png', 'service-gallery-4.png', 'service-gallery-5.png'],

            // Service 2: Interior Design - 5 images
            2 => ['service-gallery-6.png', 'service-gallery-7.png', 'service-gallery-8.png', 'service-gallery-1.png', 'service-gallery-2.png'],

            // Service 3: Woodwork & Carpentry - 5 images
            3 => ['service-gallery-3.png', 'service-gallery-4.png', 'service-gallery-5.png', 'service-gallery-6.png', 'service-gallery-7.png'],

            // Service 4: False Ceiling & Gypsum - 5 images
            4 => ['service-gallery-8.png', 'service-gallery-1.png', 'service-gallery-2.png', 'service-gallery-3.png', 'service-gallery-4.png'],

            // Service 5: Flooring & Finishing - 5 images
            5 => ['service-gallery-5.png', 'service-gallery-6.png', 'service-gallery-7.png', 'service-gallery-8.png', 'service-gallery-1.png'],

            // Service 6: Consultation Services - 5 images
            6 => ['service-gallery-2.png', 'service-gallery-3.png', 'service-gallery-4.png', 'service-gallery-5.png', 'service-gallery-6.png'],
        ];

        foreach ($serviceGalleries as $serviceId => $images) {
            $service = Service::find($serviceId);

            if (!$service) {
                $this->command->warn("Service ID {$serviceId} not found, skipping...");
                continue;
            }

            // Clear existing gallery images
            $service->clearMediaCollection('gallery');

            // Add new gallery images
            foreach ($images as $image) {
                $imagePath = public_path('images/' . $image);

                if (file_exists($imagePath)) {
                    $service->addMedia($imagePath)
                        ->preservingOriginal()
                        ->toMediaCollection('gallery');
                } else {
                    $this->command->warn("Image not found: {$imagePath}");
                }
            }

            $this->command->info("Added " . count($images) . " gallery images to service: {$service->getTranslation('title', 'en')}");
        }

        $this->command->info('Service galleries seeded successfully!');
    }
}
