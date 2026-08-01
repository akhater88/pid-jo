<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('group')->index();
            $table->string('name');
            $table->boolean('locked');
            $table->json('payload');
            $table->timestamps();

            $table->unique(['group', 'name']);
        });

        // Seed default contact settings
        $this->seedDefaultSettings();
    }

    /**
     * Seed default settings.
     */
    protected function seedDefaultSettings(): void
    {
        DB::table('settings')->insert([
            [
                'group' => 'site',
                'name' => 'administration_phone',
                'locked' => false,
                'payload' => json_encode([
                    'en' => '+962 6 55 3 11 77 , +962 77 00 2 32 42',
                    'ar' => '+962 6 55 3 11 77 , +962 77 00 2 32 42',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group' => 'site',
                'name' => 'showroom_phone',
                'locked' => false,
                'payload' => json_encode([
                    'en' => '+962 6 567 58 58 , +962 77 100 23 23',
                    'ar' => '+962 6 567 58 58 , +962 77 100 23 23',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group' => 'site',
                'name' => 'email',
                'locked' => false,
                'payload' => json_encode('info@pid-jo.com'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group' => 'site',
                'name' => 'location',
                'locked' => false,
                'payload' => json_encode([
                    'en' => 'Amman, Jordan - Khalda, Rawan Mall',
                    'ar' => 'عمان، الأردن - خلدا، روان مول',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group' => 'site',
                'name' => 'facebook_url',
                'locked' => false,
                'payload' => json_encode(null),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group' => 'site',
                'name' => 'instagram_url',
                'locked' => false,
                'payload' => json_encode(null),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group' => 'site',
                'name' => 'linkedin_url',
                'locked' => false,
                'payload' => json_encode(null),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group' => 'site',
                'name' => 'youtube_url',
                'locked' => false,
                'payload' => json_encode(null),
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
        Schema::dropIfExists('settings');
    }
};
