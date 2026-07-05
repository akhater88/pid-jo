<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $homePage = Page::create([
            'title' => [
                'en' => 'Home',
                'ar' => 'الرئيسية',
            ],
            'slug' => [
                'en' => 'home',
                'ar' => 'الرئيسية',
            ],
            'blocks' => [
                'en' => [
                    [
                        'type' => 'hero-home',
                        'data' => [
                            'title' => 'Transform Your Space with Pesaro',
                            'subtitle' => 'Interior Design Excellence',
                            'description' => 'Premium interior design and finishing services in Amman, Jordan. From kitchens to complete home renovations.',
                            'cta_text' => 'Start Your Project',
                            'cta_url' => '/en/contact',
                        ],
                    ],
                    [
                        'type' => 'services-grid',
                        'data' => [
                            'heading' => 'Our Services',
                            'subheading' => 'What We Do',
                            'description' => 'Comprehensive interior design solutions tailored to your needs',
                            'limit' => 6,
                            'show_all_link' => true,
                        ],
                    ],
                    [
                        'type' => 'testimonials-carousel',
                        'data' => [
                            'heading' => 'What Our Clients Say',
                            'subheading' => 'Testimonials',
                            'description' => 'Don\'t just take our word for it - hear from our satisfied clients',
                        ],
                    ],
                    [
                        'type' => 'news-grid',
                        'data' => [
                            'heading' => 'Latest News & Insights',
                            'subheading' => 'Blog',
                            'description' => 'Stay updated with the latest trends and tips',
                            'limit' => 3,
                            'show_all_link' => true,
                        ],
                    ],
                ],
                'ar' => [
                    [
                        'type' => 'hero-home',
                        'data' => [
                            'title' => 'حول مساحتك مع بيسارو',
                            'subtitle' => 'التميز في التصميم الداخلي',
                            'description' => 'خدمات التصميم الداخلي والتشطيب الفاخرة في عمان، الأردن. من المطابخ إلى تجديدات المنازل الكاملة.',
                            'cta_text' => 'ابدأ مشروعك',
                            'cta_url' => '/ar/contact',
                        ],
                    ],
                    [
                        'type' => 'services-grid',
                        'data' => [
                            'heading' => 'خدماتنا',
                            'subheading' => 'ما نقدمه',
                            'description' => 'حلول تصميم داخلي شاملة مصممة خصيصًا لاحتياجاتك',
                            'limit' => 6,
                            'show_all_link' => true,
                        ],
                    ],
                    [
                        'type' => 'testimonials-carousel',
                        'data' => [
                            'heading' => 'ما يقوله عملاؤنا',
                            'subheading' => 'الشهادات',
                            'description' => 'لا تأخذ كلمتنا فقط - استمع إلى عملائنا الراضين',
                        ],
                    ],
                    [
                        'type' => 'news-grid',
                        'data' => [
                            'heading' => 'آخر الأخبار والرؤى',
                            'subheading' => 'المدونة',
                            'description' => 'ابق على اطلاع بأحدث الاتجاهات والنصائح',
                            'limit' => 3,
                            'show_all_link' => true,
                        ],
                    ],
                ],
            ],
            'seo_title' => [
                'en' => 'Pesaro - Interior Design & Finishing Services in Amman',
                'ar' => 'بيسارو - خدمات التصميم الداخلي والتشطيب في عمان',
            ],
            'seo_description' => [
                'en' => 'Premium interior design, kitchen design, and finishing services in Amman, Jordan. Transform your space with Pesaro.',
                'ar' => 'خدمات التصميم الداخلي وتصميم المطابخ والتشطيب الفاخرة في عمان، الأردن. حول مساحتك مع بيسارو.',
            ],
            'published_at' => now(),
            'sort_order' => 0,
        ]);

        if ($this->command !== null) {
            $this->command->info('Home page seeded successfully!');
        }
    }
}
