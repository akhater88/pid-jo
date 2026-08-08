<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get existing site settings
        $settings = DB::table('settings')->where('group', 'site')->first();

        if ($settings) {
            $payload = json_decode($settings->payload, true);

            // Add new footer settings with null defaults
            $payload['footer_background_image'] = null;
            $payload['google_maps_url'] = null;

            // Update the settings
            DB::table('settings')
                ->where('group', 'site')
                ->update([
                    'payload' => json_encode($payload),
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Get existing site settings
        $settings = DB::table('settings')->where('group', 'site')->first();

        if ($settings) {
            $payload = json_decode($settings->payload, true);

            // Remove footer settings
            unset($payload['footer_background_image']);
            unset($payload['google_maps_url']);

            // Update the settings
            DB::table('settings')
                ->where('group', 'site')
                ->update([
                    'payload' => json_encode($payload),
                ]);
        }
    }
};
