<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define blocks for English version
        $blocksEn = [
            // 1. About Hero
            [
                'type' => 'about-hero',
                'data' => [
                    'title' => 'About Us',
                    'background_image' => '/images/about-hero-bg.jpg',
                ],
            ],

            // 2. About Content (Video + Text)
            [
                'type' => 'about-content',
                'data' => [
                    'video_thumbnail' => '/images/about-content-image.jpg',
                    'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'content_title' => 'Saudi Liver Diseases and Transplantation Society Conference 2024',
                    'content_body' => '<p>The city of Riyadh will host the Saudi Association for Liver Diseases and Transplantation Conference 2024 to discuss developments in the medical field of liver diseases in the .</p><p>The Saudi Association for Liver Diseases and Transplantation Conference 2024 is scheduled to be held from October 17-19 with a wide medical presence and the participation of local and international experts and specialists. All this is to showcase the latest technologies and new developments in the field of liver diseases and their treatment.</p><p>The conference\'s activities will include various sessions, including dialogue sessions and specialized training workshops to discuss various areas related to liver diseases and their early diagnosis.</p><p>The Saudi Association for Liver Diseases and Transplantation, during its activities, works to enhance the contribution to the advancement of science and the dissemination of knowledge. It also</p>',
                ],
            ],

            // 3. About Timeline
            [
                'type' => 'about-timeline',
                'data' => [
                    'section_badge' => 'Our Story',
                    'section_title' => 'Explore Our Comprehensive Interior Design Services',
                    'timeline_1951_image' => '/images/about-timeline-1951.jpg',
                    'center_title' => 'Supervision & execution Accessories',
                    'center_description' => 'Powerful project management tools for your companies of all sizes. companies of all sizes.',
                    'timeline_2026_image' => '/images/about-timeline-2026.jpg',
                ],
            ],
        ];

        // Define blocks for Arabic version
        $blocksAr = [
            // 1. About Hero
            [
                'type' => 'about-hero',
                'data' => [
                    'title' => 'من نحن',
                    'background_image' => '/images/about-hero-bg.jpg',
                ],
            ],

            // 2. About Content (Video + Text)
            [
                'type' => 'about-content',
                'data' => [
                    'video_thumbnail' => '/images/about-content-image.jpg',
                    'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'content_title' => 'مؤتمر الجمعية السعودية لأمراض الكبد والزراعة 2024',
                    'content_body' => '<p>ستستضيف مدينة الرياض مؤتمر الجمعية السعودية لأمراض الكبد والزراعة 2024 لمناقشة التطورات في المجال الطبي لأمراض الكبد.</p><p>من المقرر عقد مؤتمر الجمعية السعودية لأمراض الكبد والزراعة 2024 في الفترة من 17-19 أكتوبر بحضور طبي واسع ومشاركة خبراء ومتخصصين محليين ودوليين. كل هذا لعرض أحدث التقنيات والتطورات الجديدة في مجال أمراض الكبد وعلاجها.</p><p>ستتضمن أنشطة المؤتمر جلسات متنوعة، بما في ذلك جلسات الحوار وورش العمل التدريبية المتخصصة لمناقشة مختلف المجالات المتعلقة بأمراض الكبد وتشخيصها المبكر.</p><p>تعمل الجمعية السعودية لأمراض الكبد والزراعة، خلال أنشطتها، على تعزيز المساهمة في النهوض بالعلم ونشر المعرفة. كما</p>',
                ],
            ],

            // 3. About Timeline
            [
                'type' => 'about-timeline',
                'data' => [
                    'section_badge' => 'قصتنا',
                    'section_title' => 'استكشف خدماتنا الشاملة للتصميم الداخلي',
                    'timeline_1951_image' => '/images/about-timeline-1951.jpg',
                    'center_title' => 'إشراف وتنفيذ الإكسسوارات',
                    'center_description' => 'أدوات إدارة مشاريع قوية لشركاتك من جميع الأحجام.',
                    'timeline_2026_image' => '/images/about-timeline-2026.jpg',
                ],
            ],
        ];

        // Create or update About Us page
        Page::updateOrCreate(
            ['id' => 2], // About page ID
            [
                'title' => [
                    'en' => 'About Us',
                    'ar' => 'من نحن',
                ],
                'slug' => [
                    'en' => 'about',
                    'ar' => 'من-نحن',
                ],
                'blocks' => [
                    'en' => $blocksEn,
                    'ar' => $blocksAr,
                ],
                'seo_title' => [
                    'en' => 'About Us - Pesaro Interior Design',
                    'ar' => 'من نحن - بيزارو للتصميم الداخلي',
                ],
                'seo_description' => [
                    'en' => 'Learn more about Pesaro, your trusted interior design partner in Amman, Jordan since 1951.',
                    'ar' => 'تعرف على المزيد عن بيزارو، شريكك الموثوق للتصميم الداخلي في عمان، الأردن منذ عام 1951.',
                ],
                'published_at' => now(),
                'sort_order' => 2,
            ]
        );

        $this->command->info('About Us page created/updated successfully with blocks!');
    }
}
