<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => [
                    'en' => 'Sarah Al-Abdullah',
                    'ar' => 'سارة العبدالله',
                ],
                'client_title' => [
                    'en' => 'Homeowner, Abdoun',
                    'ar' => 'صاحبة منزل، عبدون',
                ],
                'testimonial' => [
                    'en' => 'Pesaro transformed our kitchen into a beautiful and functional space. The team was professional, attentive to our needs, and completed the project on time. We couldn\'t be happier with the results!',
                    'ar' => 'حول بيسارو مطبخنا إلى مساحة جميلة وعملية. كان الفريق محترفًا ومهتمًا باحتياجاتنا وأنجز المشروع في الوقت المحدد. لا يمكن أن نكون أكثر سعادة بالنتائج!',
                ],
                'rating' => 5,
                'published_at' => now(),
                'sort_order' => 1,
            ],
            [
                'client_name' => [
                    'en' => 'Mohammad Khaled',
                    'ar' => 'محمد خالد',
                ],
                'client_title' => [
                    'en' => 'Business Owner',
                    'ar' => 'صاحب عمل',
                ],
                'testimonial' => [
                    'en' => 'Outstanding service from start to finish. The interior design team at Pesaro understood our vision perfectly and delivered beyond our expectations. Highly recommended!',
                    'ar' => 'خدمة ممتازة من البداية إلى النهاية. فهم فريق التصميم الداخلي في بيسارو رؤيتنا بشكل مثالي وقدم أكثر من توقعاتنا. موصى به بشدة!',
                ],
                'rating' => 5,
                'published_at' => now(),
                'sort_order' => 2,
            ],
            [
                'client_name' => [
                    'en' => 'Layla Hassan',
                    'ar' => 'ليلى حسن',
                ],
                'client_title' => [
                    'en' => 'Architect',
                    'ar' => 'مهندسة معمارية',
                ],
                'testimonial' => [
                    'en' => 'As an architect, I appreciate quality craftsmanship. Pesaro\'s attention to detail and use of premium materials is exceptional. Their woodwork is truly an art form.',
                    'ar' => 'كمهندسة معمارية، أقدر الحرفية الجيدة. اهتمام بيسارو بالتفاصيل واستخدام المواد الفاخرة استثنائي. أعمالهم الخشبية هي حقًا شكل من أشكال الفن.',
                ],
                'rating' => 5,
                'published_at' => now(),
                'sort_order' => 3,
            ],
            [
                'client_name' => [
                    'en' => 'Ahmed Nasser',
                    'ar' => 'أحمد ناصر',
                ],
                'client_title' => [
                    'en' => 'Villa Owner, Khalda',
                    'ar' => 'صاحب فيلا، خلدا',
                ],
                'testimonial' => [
                    'en' => 'We hired Pesaro for a complete villa renovation. The project management was excellent, and the quality of work exceeded our expectations. Worth every penny!',
                    'ar' => 'استأجرنا بيسارو لتجديد كامل للفيلا. كانت إدارة المشروع ممتازة، وجودة العمل تجاوزت توقعاتنا. يستحق كل قرش!',
                ],
                'rating' => 5,
                'published_at' => now(),
                'sort_order' => 4,
            ],
            [
                'client_name' => [
                    'en' => 'Rania Yousef',
                    'ar' => 'رانيا يوسف',
                ],
                'client_title' => [
                    'en' => 'Interior Designer',
                    'ar' => 'مصممة داخلية',
                ],
                'testimonial' => [
                    'en' => 'I frequently collaborate with Pesaro on my projects. Their execution is always flawless, and they bring creative solutions to any challenge. True professionals!',
                    'ar' => 'أتعاون بشكل متكرر مع بيسارو في مشاريعي. تنفيذهم دائمًا لا تشوبه شائبة، ويقدمون حلولًا إبداعية لأي تحدٍ. محترفون حقيقيون!',
                ],
                'rating' => 5,
                'published_at' => now(),
                'sort_order' => 5,
            ],
        ];

        foreach ($testimonials as $testimonialData) {
            Testimonial::create($testimonialData);
        }

        if ($this->command !== null) {
            $this->command->info('Testimonials seeded successfully!');
        }
    }
}
