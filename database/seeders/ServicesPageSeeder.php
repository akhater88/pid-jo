<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class ServicesPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define blocks for English version
        $blocksEn = [
            // 1. Services Hero
            [
                'type' => 'services-hero',
                'data' => [
                    'title' => 'Our Services',
                    'background_image' => '/images/services-hero-bg.jpg',
                ],
            ],

            // 2. Services List
            [
                'type' => 'services-list',
                'data' => [
                    'section_title' => 'Explore Our Comprehensive Interior Design Services',
                    'gallery_limit' => 5,
                ],
            ],
        ];

        // Define blocks for Arabic version
        $blocksAr = [
            // 1. Services Hero
            [
                'type' => 'services-hero',
                'data' => [
                    'title' => 'خدماتنا',
                    'background_image' => '/images/services-hero-bg.jpg',
                ],
            ],

            // 2. Services List
            [
                'type' => 'services-list',
                'data' => [
                    'section_title' => 'استكشف خدماتنا الشاملة للتصميم الداخلي',
                    'gallery_limit' => 5,
                ],
            ],
        ];

        // Create or update Services page
        Page::updateOrCreate(
            ['id' => 4], // Services page ID
            [
                'title' => [
                    'en' => 'Our Services',
                    'ar' => 'خدماتنا',
                ],
                'slug' => [
                    'en' => 'services',
                    'ar' => 'services',
                ],
                'blocks' => [
                    'en' => $blocksEn,
                    'ar' => $blocksAr,
                ],
                'seo_title' => [
                    'en' => 'Our Services - Pesaro Interior Design',
                    'ar' => 'خدماتنا - بيزارو للتصميم الداخلي',
                ],
                'seo_description' => [
                    'en' => 'Discover our comprehensive interior design services including kitchens, decoration, consultations, and more.',
                    'ar' => 'اكتشف خدماتنا الشاملة للتصميم الداخلي بما في ذلك المطابخ والديكور والاستشارات والمزيد.',
                ],
                'published_at' => now(),
                'sort_order' => 4,
            ]
        );

        $this->command->info('Services page created/updated successfully with blocks!');
    }
}
