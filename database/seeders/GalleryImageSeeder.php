<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use Illuminate\Database\Seeder;

class GalleryImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = GalleryImage::all();

        $placeholderImages = [
            public_path('images/footer-gallery-1.png'),
            public_path('images/footer-gallery-2.png'),
            public_path('images/footer-gallery-3.png'),
        ];

        foreach ($images as $index => $image) {
            $placeholderIndex = $index % count($placeholderImages);
            $placeholderPath = $placeholderImages[$placeholderIndex];

            if (file_exists($placeholderPath) && !$image->hasMedia('image')) {
                $image->addMedia($placeholderPath)
                    ->preservingOriginal()
                    ->toMediaCollection('image');

                $this->command->info("Attached placeholder image to gallery image #{$image->id}");
            }
        }

        $this->command->info('Gallery images seeded successfully!');
    }
}
