<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => [
                    'en' => '2024 Interior Design Trends',
                    'ar' => 'اتجاهات التصميم الداخلي 2024',
                ],
                'slug' => [
                    'en' => '2024-interior-design-trends',
                    'ar' => 'اتجاهات-التصميم-الداخلي-2024',
                ],
                'excerpt' => [
                    'en' => 'Discover the latest interior design trends that will shape homes in 2024. From sustainable materials to bold colors.',
                    'ar' => 'اكتشف أحدث اتجاهات التصميم الداخلي التي ستشكل المنازل في عام 2024. من المواد المستدامة إلى الألوان الجريئة.',
                ],
                'body' => [
                    'en' => '<h2>Sustainable Living</h2><p>Eco-friendly materials and sustainable design practices are at the forefront of 2024 trends. Homeowners are increasingly choosing materials that are both beautiful and environmentally responsible.</p><h2>Natural Elements</h2><p>Bringing the outdoors in with natural wood, stone, and plant-based decor continues to be a major trend. These elements create a calming, organic atmosphere in any space.</p><h2>Bold Color Choices</h2><p>While neutrals remain popular, we\'re seeing more homeowners embrace bold, saturated colors as accent walls and statement pieces.</p>',
                    'ar' => '<h2>الحياة المستدامة</h2><p>المواد الصديقة للبيئة وممارسات التصميم المستدام في طليعة اتجاهات عام 2024. يختار أصحاب المنازل بشكل متزايد المواد الجميلة والمسؤولة بيئيًا.</p><h2>العناصر الطبيعية</h2><p>إحضار الهواء الطلق إلى الداخل مع الخشب الطبيعي والحجر والديكور النباتي يستمر في كونه اتجاهًا رئيسيًا. تخلق هذه العناصر جوًا هادئًا وعضويًا في أي مساحة.</p><h2>خيارات الألوان الجريئة</h2><p>بينما تظل الألوان المحايدة شائعة، نرى المزيد من أصحاب المنازل يتبنون ألوانًا جريئة ومشبعة كجدران مميزة وقطع بارزة.</p>',
                ],
                'published_at' => now()->subDays(5),
                'sort_order' => 1,
            ],
            [
                'title' => [
                    'en' => 'Kitchen Renovation: Where to Start',
                    'ar' => 'تجديد المطبخ: من أين تبدأ',
                ],
                'slug' => [
                    'en' => 'kitchen-renovation-guide',
                    'ar' => 'دليل-تجديد-المطبخ',
                ],
                'excerpt' => [
                    'en' => 'Planning a kitchen renovation? Here\'s your complete guide to getting started with your dream kitchen project.',
                    'ar' => 'هل تخطط لتجديد المطبخ؟ إليك دليلك الكامل للبدء بمشروع مطبخ أحلامك.',
                ],
                'body' => [
                    'en' => '<h2>Set Your Budget</h2><p>Before you begin, establish a realistic budget that includes materials, labor, and a contingency fund for unexpected costs.</p><h2>Define Your Style</h2><p>Research different kitchen styles and collect inspiration. Are you drawn to modern minimalism, rustic charm, or classic elegance?</p><h2>Plan the Layout</h2><p>Consider the work triangle between your sink, stove, and refrigerator. An efficient layout is key to a functional kitchen.</p><h2>Choose Quality Materials</h2><p>Invest in durable materials that will stand the test of time, especially for countertops and cabinets.</p>',
                    'ar' => '<h2>حدد ميزانيتك</h2><p>قبل أن تبدأ، ضع ميزانية واقعية تشمل المواد والعمالة وصندوق طوارئ للتكاليف غير المتوقعة.</p><h2>حدد أسلوبك</h2><p>ابحث عن أنماط المطابخ المختلفة واجمع الإلهام. هل تنجذب إلى البساطة الحديثة أو السحر الريفي أو الأناقة الكلاسيكية؟</p><h2>خطط للتخطيط</h2><p>ضع في اعتبارك مثلث العمل بين الحوض والموقد والثلاجة. التصميم الفعال هو مفتاح المطبخ الوظيفي.</p><h2>اختر مواد عالية الجودة</h2><p>استثمر في مواد متينة ستصمد أمام اختبار الزمن، خاصة لأسطح العمل والخزائن.</p>',
                ],
                'published_at' => now()->subDays(12),
                'sort_order' => 2,
            ],
            [
                'title' => [
                    'en' => 'The Art of Lighting Design',
                    'ar' => 'فن تصميم الإضاءة',
                ],
                'slug' => [
                    'en' => 'lighting-design-guide',
                    'ar' => 'دليل-تصميم-الإضاءة',
                ],
                'excerpt' => [
                    'en' => 'Good lighting can transform any space. Learn how to layer lighting for maximum impact and functionality.',
                    'ar' => 'يمكن للإضاءة الجيدة أن تحول أي مساحة. تعلم كيفية طبقات الإضاءة لتحقيق أقصى تأثير ووظيفة.',
                ],
                'body' => [
                    'en' => '<h2>Three Layers of Lighting</h2><p>Effective lighting design uses three layers: ambient, task, and accent lighting. Each serves a specific purpose in your space.</p><h2>Ambient Lighting</h2><p>This is your primary light source, providing overall illumination for the room. Think ceiling fixtures and recessed lighting.</p><h2>Task Lighting</h2><p>Focused light for specific activities like reading, cooking, or working. Examples include desk lamps and under-cabinet lighting.</p><h2>Accent Lighting</h2><p>Used to highlight architectural features, artwork, or create mood. Wall sconces and spotlights work well here.</p>',
                    'ar' => '<h2>ثلاث طبقات من الإضاءة</h2><p>يستخدم تصميم الإضاءة الفعال ثلاث طبقات: الإضاءة المحيطة والمهام والتركيز. كل واحدة تخدم غرضًا محددًا في مساحتك.</p><h2>الإضاءة المحيطة</h2><p>هذا هو مصدر الضوء الأساسي الخاص بك، والذي يوفر إضاءة عامة للغرفة. فكر في تركيبات السقف والإضاءة المخفية.</p><h2>إضاءة المهام</h2><p>ضوء مركز لأنشطة محددة مثل القراءة أو الطبخ أو العمل. تشمل الأمثلة مصابيح المكتب والإضاءة تحت الخزانة.</p><h2>إضاءة التركيز</h2><p>تستخدم لتسليط الضوء على الميزات المعمارية أو الأعمال الفنية أو خلق الحالة المزاجية. تعمل المصابيح الجدارية والكشافات بشكل جيد هنا.</p>',
                ],
                'published_at' => now()->subDays(18),
                'sort_order' => 3,
            ],
        ];

        foreach ($posts as $postData) {
            BlogPost::create($postData);
        }

        if ($this->command !== null) {
            $this->command->info('Blog posts seeded successfully!');
        }
    }
}
