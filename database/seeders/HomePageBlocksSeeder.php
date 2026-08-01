<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class HomePageBlocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $page = Page::find(1);

        if (!$page) {
            $this->command->error('Page ID 1 not found! Please create the homepage first.');

            return;
        }

        // Define blocks for English version
        $blocksEn = [
            // 1. Hero Section
            [
                'type' => 'hero-home',
                'data' => [
                    'title' => 'Manage your all transaction without',
                    'subtitle' => 'Fast and Realable',
                    'description' => 'With Finnen, you can transfer your money in a second. We also provide you with secure transfer.',
                    'cta_text' => 'Explore Services',
                    'cta_url' => '/services',
                    'background_image' => null, // Will use default from public/images
                ],
            ],

            // 2. About Section with Benefits
            [
                'type' => 'about-benefits',
                'data' => [
                    'section_label' => 'About US',
                    'section_title' => 'What the Benefit <span class="gold">to get Work with</span> Pesaro',
                    'description' => 'With Finnen, you can transfer your money in a second. We also provide you with secure transfer, don\'t need any frustations! Sometimes, I\'m really impress with my own product provide you with secure transfer.',
                    'main_image' => null, // Will use default from public/images
                    'small_image' => null, // Will use default from public/images
                    'benefits' => [
                        [
                            'title' => 'User Experience Design Team.',
                            'description' => 'Etiam sed vulputate nisl, eu elementum arcu. Vivamus dignsim tortor in tellus dictum pellentesque.',
                        ],
                        [
                            'title' => 'User Experience Design Team.',
                            'description' => 'Etiam sed vulputate nisl, eu elementum arcu. Vivamus dignsim tortor in tellus dictum pellentesque.',
                        ],
                    ],
                ],
            ],

            // 3. Services Grid
            [
                'type' => 'services-grid',
                'data' => [
                    'heading' => 'Our Services',
                    'subheading' => 'Explore What We Offer',
                    'columns' => 3,
                    'limit' => 6,
                    'show_all_link' => true,
                    'button_text' => 'View All Services',
                    'button_link' => '/services',
                ],
            ],

            // 4. News Grid
            [
                'type' => 'news-grid',
                'data' => [
                    'heading' => 'Latest News & Blogs',
                    'subheading' => 'Stay Updated',
                    'columns' => 3,
                    'limit' => 3,
                    'show_all_link' => true,
                    'button_text' => 'View All Posts',
                    'button_link' => '/blog',
                ],
            ],

            // 5. Testimonials Carousel
            [
                'type' => 'testimonials-carousel',
                'data' => [
                    'heading' => 'What Our Clients Say',
                    'subheading' => 'Testimonials',
                    'auto_play' => true,
                    'auto_play_speed' => 5000,
                ],
            ],
        ];

        // Define blocks for Arabic version (same structure, different text)
        $blocksAr = [
            // 1. Hero Section
            [
                'type' => 'hero-home',
                'data' => [
                    'title' => 'إدارة جميع معاملاتك بدون',
                    'subtitle' => 'سريع وموثوق',
                    'description' => 'مع Finnen، يمكنك تحويل أموالك في ثانية واحدة. نحن نوفر لك أيضًا تحويلاً آمنًا.',
                    'cta_text' => 'استكشف الخدمات',
                    'cta_url' => '/services',
                    'background_image' => null,
                ],
            ],

            // 2. About Section with Benefits
            [
                'type' => 'about-benefits',
                'data' => [
                    'section_label' => 'من نحن',
                    'section_title' => 'ما هي الفائدة <span class="gold">من العمل مع</span> بيسارو',
                    'description' => 'مع Finnen، يمكنك تحويل أموالك في ثانية واحدة. نحن نوفر لك أيضًا تحويلاً آمنًا، لا حاجة لأي إحباط! في بعض الأحيان، أنا معجب حقًا بمنتجي الخاص.',
                    'main_image' => null,
                    'small_image' => null,
                    'benefits' => [
                        [
                            'title' => 'فريق تصميم تجربة المستخدم',
                            'description' => 'Etiam sed vulputate nisl, eu elementum arcu. Vivamus dignsim tortor in tellus dictum pellentesque.',
                        ],
                        [
                            'title' => 'فريق تصميم تجربة المستخدم',
                            'description' => 'Etiam sed vulputate nisl, eu elementum arcu. Vivamus dignsim tortor in tellus dictum pellentesque.',
                        ],
                    ],
                ],
            ],

            // 3. Services Grid
            [
                'type' => 'services-grid',
                'data' => [
                    'heading' => 'خدماتنا',
                    'subheading' => 'استكشف ما نقدمه',
                    'columns' => 3,
                    'limit' => 6,
                    'show_all_link' => true,
                    'button_text' => 'عرض جميع الخدمات',
                    'button_link' => '/services',
                ],
            ],

            // 4. News Grid
            [
                'type' => 'news-grid',
                'data' => [
                    'heading' => 'آخر الأخبار والمدونات',
                    'subheading' => 'ابق على اطلاع',
                    'columns' => 3,
                    'limit' => 3,
                    'show_all_link' => true,
                    'button_text' => 'عرض جميع المقالات',
                    'button_link' => '/blog',
                ],
            ],

            // 5. Testimonials Carousel
            [
                'type' => 'testimonials-carousel',
                'data' => [
                    'heading' => 'ماذا يقول عملاؤنا',
                    'subheading' => 'الشهادات',
                    'auto_play' => true,
                    'auto_play_speed' => 5000,
                ],
            ],
        ];

        // Update the page with blocks
        $page->setTranslation('blocks', 'en', $blocksEn);
        $page->setTranslation('blocks', 'ar', $blocksAr);
        $page->save();

        $this->command->info('✓ Homepage blocks seeded successfully for page ID 1');
        $this->command->info('✓ Created 5 blocks for English version');
        $this->command->info('✓ Created 5 blocks for Arabic version');
    }
}
