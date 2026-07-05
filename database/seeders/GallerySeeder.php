<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Note: This seeder creates gallery records without actual images
        // In production, you would upload actual images through the admin panel
        $images = [
            [
                'title' => [
                    'en' => 'Modern Kitchen Design',
                    'ar' => 'تصميم مطبخ حديث',
                ],
                'description' => [
                    'en' => 'Contemporary kitchen with sleek cabinets and marble countertops',
                    'ar' => 'مطبخ عصري مع خزائن أنيقة وأسطح عمل رخامية',
                ],
                'show_in_footer' => true,
                'published_at' => now(),
                'sort_order' => 1,
            ],
            [
                'title' => [
                    'en' => 'Luxury Living Room',
                    'ar' => 'غرفة معيشة فاخرة',
                ],
                'description' => [
                    'en' => 'Elegant living space with custom woodwork and lighting',
                    'ar' => 'مساحة معيشة أنيقة مع أعمال خشبية وإضاءة مخصصة',
                ],
                'show_in_footer' => true,
                'published_at' => now(),
                'sort_order' => 2,
            ],
            [
                'title' => [
                    'en' => 'Master Bedroom Suite',
                    'ar' => 'جناح غرفة النوم الرئيسية',
                ],
                'description' => [
                    'en' => 'Sophisticated bedroom with built-in wardrobes',
                    'ar' => 'غرفة نوم راقية مع خزائن مدمجة',
                ],
                'show_in_footer' => true,
                'published_at' => now(),
                'sort_order' => 3,
            ],
            [
                'title' => [
                    'en' => 'False Ceiling Detail',
                    'ar' => 'تفاصيل السقف المستعار',
                ],
                'description' => [
                    'en' => 'Intricate gypsum ceiling with integrated LED lighting',
                    'ar' => 'سقف جبس معقد مع إضاءة LED متكاملة',
                ],
                'show_in_footer' => true,
                'published_at' => now(),
                'sort_order' => 4,
            ],
            [
                'title' => [
                    'en' => 'Dining Area',
                    'ar' => 'منطقة الطعام',
                ],
                'description' => [
                    'en' => 'Open-concept dining space with modern fixtures',
                    'ar' => 'مساحة طعام مفتوحة المفهوم مع تركيبات حديثة',
                ],
                'show_in_footer' => true,
                'published_at' => now(),
                'sort_order' => 5,
            ],
            [
                'title' => [
                    'en' => 'Office Space',
                    'ar' => 'مساحة المكتب',
                ],
                'description' => [
                    'en' => 'Professional home office with custom shelving',
                    'ar' => 'مكتب منزلي احترافي مع أرفف مخصصة',
                ],
                'show_in_footer' => true,
                'published_at' => now(),
                'sort_order' => 6,
            ],
            [
                'title' => [
                    'en' => 'Bathroom Design',
                    'ar' => 'تصميم الحمام',
                ],
                'description' => [
                    'en' => 'Spa-like bathroom with premium finishes',
                    'ar' => 'حمام يشبه السبا مع تشطيبات فاخرة',
                ],
                'show_in_footer' => true,
                'published_at' => now(),
                'sort_order' => 7,
            ],
            [
                'title' => [
                    'en' => 'Entrance Foyer',
                    'ar' => 'بهو المدخل',
                ],
                'description' => [
                    'en' => 'Grand entrance with marble flooring and chandelier',
                    'ar' => 'مدخل كبير مع أرضيات رخامية وثريا',
                ],
                'show_in_footer' => true,
                'published_at' => now(),
                'sort_order' => 8,
            ],
            [
                'title' => [
                    'en' => 'Kids Room',
                    'ar' => 'غرفة الأطفال',
                ],
                'description' => [
                    'en' => 'Playful children\'s room with creative storage solutions',
                    'ar' => 'غرفة أطفال مرحة مع حلول تخزين إبداعية',
                ],
                'show_in_footer' => true,
                'published_at' => now(),
                'sort_order' => 9,
            ],
        ];

        foreach ($images as $imageData) {
            GalleryImage::create($imageData);
        }

        if ($this->command !== null) {
            $this->command->info('Gallery images seeded successfully!');
            $this->command->warn('Note: Gallery records created without actual images. Upload images through admin panel.');
        }
    }
}
