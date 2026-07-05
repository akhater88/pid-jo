<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => [
                    'en' => 'How long does a typical kitchen renovation take?',
                    'ar' => 'كم من الوقت يستغرق تجديد المطبخ النموذجي؟',
                ],
                'answer' => [
                    'en' => 'A typical kitchen renovation takes 4-8 weeks depending on the scope of work. This includes design, demolition, installation, and finishing. We provide a detailed timeline during the consultation phase.',
                    'ar' => 'يستغرق تجديد المطبخ النموذجي من 4 إلى 8 أسابيع حسب نطاق العمل. يشمل ذلك التصميم والهدم والتركيب والتشطيب. نقدم جدولًا زمنيًا مفصلًا خلال مرحلة الاستشارة.',
                ],
                'published_at' => now(),
                'sort_order' => 1,
            ],
            [
                'question' => [
                    'en' => 'Do you provide warranty on your work?',
                    'ar' => 'هل تقدمون ضمانًا على عملكم؟',
                ],
                'answer' => [
                    'en' => 'Yes, we provide a comprehensive warranty on all our work. The warranty period varies depending on the service, ranging from 1 to 5 years. All warranty details are clearly outlined in your contract.',
                    'ar' => 'نعم، نقدم ضمانًا شاملاً على جميع أعمالنا. تختلف فترة الضمان حسب الخدمة، وتتراوح من سنة إلى 5 سنوات. يتم توضيح جميع تفاصيل الضمان بوضوح في عقدك.',
                ],
                'published_at' => now(),
                'sort_order' => 2,
            ],
            [
                'question' => [
                    'en' => 'Can I see samples of materials before starting?',
                    'ar' => 'هل يمكنني رؤية عينات من المواد قبل البدء؟',
                ],
                'answer' => [
                    'en' => 'Absolutely! We have a showroom in Khalda, Rawan Mall where you can see and touch all our materials. We also bring samples to your location during the design consultation to help you make informed decisions.',
                    'ar' => 'بالتأكيد! لدينا صالة عرض في خلدا، روان مول حيث يمكنك رؤية ولمس جميع موادنا. نحضر أيضًا عينات إلى موقعك خلال استشارة التصميم لمساعدتك على اتخاذ قرارات مستنيرة.',
                ],
                'published_at' => now(),
                'sort_order' => 3,
            ],
            [
                'question' => [
                    'en' => 'What is your payment structure?',
                    'ar' => 'ما هو هيكل الدفع الخاص بكم؟',
                ],
                'answer' => [
                    'en' => 'Our standard payment structure is: 30% deposit upon contract signing, 40% at project midpoint, and 30% upon completion. We accept cash, bank transfers, and major credit cards.',
                    'ar' => 'هيكل الدفع القياسي لدينا هو: 30٪ دفعة عند توقيع العقد، 40٪ في منتصف المشروع، و30٪ عند الانتهاء. نقبل النقد والتحويلات المصرفية وبطاقات الائتمان الرئيسية.',
                ],
                'published_at' => now(),
                'sort_order' => 4,
            ],
            [
                'question' => [
                    'en' => 'Do you work on commercial projects?',
                    'ar' => 'هل تعملون على المشاريع التجارية؟',
                ],
                'answer' => [
                    'en' => 'Yes, we handle both residential and commercial projects. Our portfolio includes offices, restaurants, retail spaces, and hotels. Contact us to discuss your commercial project requirements.',
                    'ar' => 'نعم، نتعامل مع المشاريع السكنية والتجارية. تشمل محفظتنا المكاتب والمطاعم ومساحات البيع بالتجزئة والفنادق. اتصل بنا لمناقشة متطلبات مشروعك التجاري.',
                ],
                'published_at' => now(),
                'sort_order' => 5,
            ],
            [
                'question' => [
                    'en' => 'Can you work with my architect or designer?',
                    'ar' => 'هل يمكنكم العمل مع مهندسي أو مصممي؟',
                ],
                'answer' => [
                    'en' => 'Absolutely! We regularly collaborate with architects and designers. We can work from your existing plans or help develop the design together. Our goal is to bring your vision to life.',
                    'ar' => 'بالتأكيد! نتعاون بانتظام مع المهندسين المعماريين والمصممين. يمكننا العمل من خططك الموجودة أو المساعدة في تطوير التصميم معًا. هدفنا هو تحويل رؤيتك إلى واقع.',
                ],
                'published_at' => now(),
                'sort_order' => 6,
            ],
        ];

        foreach ($faqs as $faqData) {
            Faq::create($faqData);
        }

        if ($this->command !== null) {
            $this->command->info('FAQs seeded successfully!');
        }
    }
}
