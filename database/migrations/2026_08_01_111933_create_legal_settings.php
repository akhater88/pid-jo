<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Insert default legal settings
        DB::table('settings')->insert([
            [
                'group' => 'legal',
                'name' => 'terms_title',
                'locked' => false,
                'payload' => json_encode([
                    'en' => 'Terms & Conditions',
                    'ar' => 'الشروط والأحكام',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group' => 'legal',
                'name' => 'terms_content',
                'locked' => false,
                'payload' => json_encode([
                    'en' => '<h2>Introduction</h2><p>These Website Standard Terms and Conditions shall manage your use of our website, Pesaro accessible at www.pid-jo.com.</p><h2>Intellectual Property Rights</h2><p>Other than the content you own, under these Terms, Pesaro and/or its licensors own all the intellectual property rights and materials contained in this Website.</p><h2>Restrictions</h2><p>You are specifically restricted from publishing any Website material in any other media and selling, sublicensing, and/or otherwise commercializing any Website material.</p>',
                    'ar' => '<h2>المقدمة</h2><p>ستحكم شروط وأحكام الموقع القياسية هذه استخدامك لموقعنا على الويب، Pesaro الذي يمكن الوصول إليه على www.pid-jo.com.</p><h2>حقوق الملكية الفكرية</h2><p>بخلاف المحتوى الذي تمتلكه، بموجب هذه الشروط، تمتلك Pesaro و/أو مرخصوها جميع حقوق الملكية الفكرية والمواد الواردة في هذا الموقع.</p><h2>القيود</h2><p>يُحظر عليك على وجه التحديد نشر أي مواد من الموقع في أي وسائط أخرى وبيع أو ترخيص أو تسويق أي مواد من الموقع.</p>',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group' => 'legal',
                'name' => 'privacy_title',
                'locked' => false,
                'payload' => json_encode([
                    'en' => 'Privacy Policy',
                    'ar' => 'سياسة الخصوصية',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group' => 'legal',
                'name' => 'privacy_content',
                'locked' => false,
                'payload' => json_encode([
                    'en' => '<h2>Introduction</h2><p>We respect your privacy and are committed to protecting your personal information.</p><h2>Information We Collect</h2><p>We collect information you provide directly to us through our contact forms, including your name, email address, phone number, and message content.</p><h2>How We Use Your Information</h2><p>The information we collect is used to respond to your inquiries, process service requests, and improve our website and services.</p>',
                    'ar' => '<h2>المقدمة</h2><p>نحن نحترم خصوصيتك ونلتزم بحماية معلوماتك الشخصية.</p><h2>المعلومات التي نجمعها</h2><p>نجمع المعلومات التي تقدمها لنا مباشرة من خلال نماذج الاتصال الخاصة بنا، بما في ذلك اسمك وعنوان بريدك الإلكتروني ورقم هاتفك ومحتوى رسالتك.</p><h2>كيف نستخدم معلوماتك</h2><p>يتم استخدام المعلومات التي نجمعها للرد على استفساراتك ومعالجة طلبات الخدمة وتحسين موقعنا وخدماتنا.</p>',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('settings')->where('group', 'legal')->delete();
    }
};
