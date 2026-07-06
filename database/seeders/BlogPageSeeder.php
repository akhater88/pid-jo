<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class BlogPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define blocks for English version
        $blocksEn = [
            // 1. Blog Hero
            [
                'type' => 'blog-hero',
                'data' => [
                    'title' => 'News & Events',
                    'background_image' => '/images/blog-hero-bg.jpg',
                ],
            ],

            // 2. Blog List
            [
                'type' => 'blog-list',
                'data' => [
                    'section_badge' => 'News & Blogs',
                    'section_title' => 'Explore Our Comprehensive Interior Design Services',
                    'posts_per_page' => 9,
                ],
            ],
        ];

        // Define blocks for Arabic version
        $blocksAr = [
            // 1. Blog Hero
            [
                'type' => 'blog-hero',
                'data' => [
                    'title' => 'الأخبار والفعاليات',
                    'background_image' => '/images/blog-hero-bg.jpg',
                ],
            ],

            // 2. Blog List
            [
                'type' => 'blog-list',
                'data' => [
                    'section_badge' => 'الأخبار والمدونات',
                    'section_title' => 'استكشف خدماتنا الشاملة للتصميم الداخلي',
                    'posts_per_page' => 9,
                ],
            ],
        ];

        // Create or update Blog page
        Page::updateOrCreate(
            ['id' => 3], // Blog page ID
            [
                'title' => [
                    'en' => 'News & Events',
                    'ar' => 'الأخبار والفعاليات',
                ],
                'slug' => [
                    'en' => 'blog',
                    'ar' => 'blog',
                ],
                'blocks' => [
                    'en' => $blocksEn,
                    'ar' => $blocksAr,
                ],
                'seo_title' => [
                    'en' => 'News & Events - Pesaro Interior Design',
                    'ar' => 'الأخبار والفعاليات - بيزارو للتصميم الداخلي',
                ],
                'seo_description' => [
                    'en' => 'Stay updated with the latest news, trends, and insights from Pesaro Interior Design.',
                    'ar' => 'ابق على اطلاع بأحدث الأخبار والاتجاهات والأفكار من بيزارو للتصميم الداخلي.',
                ],
                'published_at' => now(),
                'sort_order' => 3,
            ]
        );

        $this->command->info('Blog page created/updated successfully with blocks!');
    }
}
