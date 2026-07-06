<?php

namespace Database\Seeders;

use App\Models\ServiceDetailTemplate;
use Illuminate\Database\Seeder;

class ServiceDetailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default service detail template
        $template = ServiceDetailTemplate::create([
            'name' => 'Default Service Template',
            'is_active' => true,
            'blocks' => [
                'en' => [
                    [
                        'type' => 'service-hero',
                        'data' => [
                            'title' => '{{service_title}}',
                            'description' => '{{service_description}}',
                            'background_image' => null,
                        ],
                    ],
                    [
                        'type' => 'service-content',
                        'data' => [
                            'content' => '{{service_body}}',
                        ],
                    ],
                    [
                        'type' => 'service-gallery',
                        'data' => [
                            'heading' => 'Project Gallery',
                            'description' => 'Browse through our completed projects',
                        ],
                    ],
                    [
                        'type' => 'service-sections',
                        'data' => [
                            'heading' => 'Additional Information',
                            'description' => 'Learn more about this service',
                        ],
                    ],
                    [
                        'type' => 'service-cta',
                        'data' => [
                            'heading' => 'Interested in this service?',
                            'description' => 'Contact us today to discuss your project and get a free consultation.',
                            'button_text' => 'Contact Us',
                            'button_link' => '/contact',
                        ],
                    ],
                ],
                'ar' => [
                    [
                        'type' => 'service-hero',
                        'data' => [
                            'title' => '{{service_title}}',
                            'description' => '{{service_description}}',
                            'background_image' => null,
                        ],
                    ],
                    [
                        'type' => 'service-content',
                        'data' => [
                            'content' => '{{service_body}}',
                        ],
                    ],
                    [
                        'type' => 'service-gallery',
                        'data' => [
                            'heading' => 'معرض المشاريع',
                            'description' => 'تصفح مشاريعنا المنجزة',
                        ],
                    ],
                    [
                        'type' => 'service-sections',
                        'data' => [
                            'heading' => 'معلومات إضافية',
                            'description' => 'تعرف على المزيد حول هذه الخدمة',
                        ],
                    ],
                    [
                        'type' => 'service-cta',
                        'data' => [
                            'heading' => 'مهتم بهذه الخدمة؟',
                            'description' => 'تواصل معنا اليوم لمناقشة مشروعك والحصول على استشارة مجانية.',
                            'button_text' => 'تواصل معنا',
                            'button_link' => '/contact',
                        ],
                    ],
                ],
            ],
        ]);

        $this->command->info('Default service detail template created successfully.');
    }
}
