<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => [
                    'en' => 'Kitchen Design',
                    'ar' => 'تصميم المطابخ',
                ],
                'slug' => [
                    'en' => 'kitchen-design',
                    'ar' => 'تصميم-المطابخ',
                ],
                'short_description' => [
                    'en' => 'Custom kitchen designs that blend functionality with aesthetics. From modern to traditional styles.',
                    'ar' => 'تصاميم مطابخ مخصصة تجمع بين الوظائف العملية والجماليات. من الأنماط الحديثة إلى التقليدية.',
                ],
                'body' => [
                    'en' => '<p>Transform your kitchen into a functional and beautiful space. Our expert designers work with you to create custom kitchen solutions that fit your lifestyle and budget.</p><p>We specialize in modern, contemporary, and traditional kitchen designs using high-quality materials and the latest technology.</p>',
                    'ar' => '<p>حول مطبخك إلى مساحة عملية وجميلة. يعمل مصممونا الخبراء معك لإنشاء حلول مطبخ مخصصة تناسب نمط حياتك وميزانيتك.</p><p>نحن متخصصون في تصاميم المطابخ الحديثة والمعاصرة والتقليدية باستخدام مواد عالية الجودة وأحدث التقنيات.</p>',
                ],
                'published_at' => now(),
                'sort_order' => 1,
            ],
            [
                'title' => [
                    'en' => 'Interior Design',
                    'ar' => 'التصميم الداخلي',
                ],
                'slug' => [
                    'en' => 'interior-design',
                    'ar' => 'التصميم-الداخلي',
                ],
                'short_description' => [
                    'en' => 'Complete interior design services for residential and commercial spaces. Creating environments that inspire.',
                    'ar' => 'خدمات تصميم داخلي شاملة للمساحات السكنية والتجارية. إنشاء بيئات ملهمة.',
                ],
                'body' => [
                    'en' => '<p>Our interior design services encompass everything from concept development to final installation. We create spaces that are not only beautiful but also functional and tailored to your needs.</p><p>Whether it\'s a single room or an entire home, we bring your vision to life.</p>',
                    'ar' => '<p>تشمل خدمات التصميم الداخلي لدينا كل شيء من تطوير المفهوم إلى التثبيت النهائي. نقوم بإنشاء مساحات ليست جميلة فحسب، بل وظيفية أيضًا ومصممة خصيصًا لتلبية احتياجاتك.</p><p>سواء كانت غرفة واحدة أو منزل كامل، نحن نحول رؤيتك إلى واقع.</p>',
                ],
                'published_at' => now(),
                'sort_order' => 2,
            ],
            [
                'title' => [
                    'en' => 'Woodwork & Carpentry',
                    'ar' => 'الأعمال الخشبية والنجارة',
                ],
                'slug' => [
                    'en' => 'woodwork-carpentry',
                    'ar' => 'الأعمال-الخشبية',
                ],
                'short_description' => [
                    'en' => 'Expert carpentry and custom woodwork. Built-in cabinets, shelving, and bespoke furniture pieces.',
                    'ar' => 'نجارة احترافية وأعمال خشبية مخصصة. خزائن مدمجة وأرفف وقطع أثاث حسب الطلب.',
                ],
                'body' => [
                    'en' => '<p>Our skilled carpenters create custom woodwork solutions that add character and functionality to your space. From built-in storage to decorative elements, we handle all aspects of carpentry.</p>',
                    'ar' => '<p>ينشئ نجارونا المهرة حلول أعمال خشبية مخصصة تضيف طابعًا ووظيفة إلى مساحتك. من التخزين المدمج إلى العناصر الزخرفية، نتعامل مع جميع جوانب النجارة.</p>',
                ],
                'published_at' => now(),
                'sort_order' => 3,
            ],
            [
                'title' => [
                    'en' => 'False Ceiling & Gypsum',
                    'ar' => 'الأسقف المستعارة والجبس',
                ],
                'slug' => [
                    'en' => 'false-ceiling-gypsum',
                    'ar' => 'الأسقف-المستعارة',
                ],
                'short_description' => [
                    'en' => 'Modern false ceiling designs with integrated lighting. Gypsum board installations and decorative elements.',
                    'ar' => 'تصاميم أسقف مستعارة حديثة مع إضاءة متكاملة. تركيبات ألواح الجبس والعناصر الزخرفية.',
                ],
                'body' => [
                    'en' => '<p>Transform your ceilings with our false ceiling and gypsum solutions. We create stunning ceiling designs that enhance your space with integrated lighting and modern aesthetics.</p>',
                    'ar' => '<p>حول أسقفك باستخدام حلول الأسقف المستعارة والجبس لدينا. نقوم بإنشاء تصاميم أسقف مذهلة تعزز مساحتك بإضاءة متكاملة وجماليات حديثة.</p>',
                ],
                'published_at' => now(),
                'sort_order' => 4,
            ],
            [
                'title' => [
                    'en' => 'Flooring & Finishing',
                    'ar' => 'الأرضيات والتشطيبات',
                ],
                'slug' => [
                    'en' => 'flooring-finishing',
                    'ar' => 'الأرضيات-والتشطيبات',
                ],
                'short_description' => [
                    'en' => 'Premium flooring solutions including marble, tiles, hardwood, and laminate. Professional finishing services.',
                    'ar' => 'حلول أرضيات فاخرة تشمل الرخام والبلاط والخشب الصلب والصفائح. خدمات تشطيب احترافية.',
                ],
                'body' => [
                    'en' => '<p>Choose from our wide range of flooring options to complement your interior design. We offer professional installation and finishing services for all types of flooring materials.</p>',
                    'ar' => '<p>اختر من بين مجموعة واسعة من خيارات الأرضيات لدينا لتكمل تصميمك الداخلي. نقدم خدمات تركيب وتشطيب احترافية لجميع أنواع مواد الأرضيات.</p>',
                ],
                'published_at' => now(),
                'sort_order' => 5,
            ],
            [
                'title' => [
                    'en' => 'Consultation Services',
                    'ar' => 'خدمات الاستشارات',
                ],
                'slug' => [
                    'en' => 'consultation-services',
                    'ar' => 'خدمات-الاستشارات',
                ],
                'short_description' => [
                    'en' => 'Expert design consultation to help you plan your project. Get professional advice and guidance.',
                    'ar' => 'استشارات تصميم احترافية لمساعدتك في التخطيط لمشروعك. احصل على نصائح وإرشادات مهنية.',
                ],
                'body' => [
                    'en' => '<p>Not sure where to start? Our consultation services provide you with expert guidance on design choices, material selection, and project planning. We help you make informed decisions for your space.</p>',
                    'ar' => '<p>غير متأكد من أين تبدأ؟ توفر لك خدمات الاستشارات لدينا إرشادات احترافية حول خيارات التصميم واختيار المواد وتخطيط المشروع. نساعدك على اتخاذ قرارات مستنيرة بشأن مساحتك.</p>',
                ],
                'published_at' => now(),
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $serviceData) {
            Service::create($serviceData);
        }

        if ($this->command !== null) {
            $this->command->info('Services seeded successfully!');
        }
    }
}
