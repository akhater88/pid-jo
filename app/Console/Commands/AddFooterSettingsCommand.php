<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AddFooterSettingsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:add-footer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add footer background image and Google Maps URL settings to the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for footer settings...');

        // Check if footer_background_image setting exists
        $footerBgExists = DB::table('settings')
            ->where('group', 'site')
            ->where('name', 'footer_background_image')
            ->exists();

        // Check if google_maps_url setting exists
        $googleMapsExists = DB::table('settings')
            ->where('group', 'site')
            ->where('name', 'google_maps_url')
            ->exists();

        $settingsAdded = [];

        // Add footer_background_image if it doesn't exist
        if (! $footerBgExists) {
            DB::table('settings')->insert([
                'group' => 'site',
                'name' => 'footer_background_image',
                'locked' => false,
                'payload' => json_encode(null),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $settingsAdded[] = 'footer_background_image';
            $this->info('✓ Added footer_background_image setting');
        } else {
            $this->comment('• footer_background_image already exists');
        }

        // Add google_maps_url if it doesn't exist
        if (! $googleMapsExists) {
            DB::table('settings')->insert([
                'group' => 'site',
                'name' => 'google_maps_url',
                'locked' => false,
                'payload' => json_encode(null),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $settingsAdded[] = 'google_maps_url';
            $this->info('✓ Added google_maps_url setting');
        } else {
            $this->comment('• google_maps_url already exists');
        }

        // Clear caches
        if (! empty($settingsAdded)) {
            $this->info('');
            $this->info('Clearing caches...');
            $this->call('cache:clear');
            $this->call('settings:discover');

            $this->newLine();
            $this->info('✅ Footer settings added successfully!');
            $this->info('You can now upload a footer background image and set Google Maps URL in Settings → Site Settings.');
        } else {
            $this->newLine();
            $this->info('✅ All footer settings already exist. Nothing to add.');
        }

        return Command::SUCCESS;
    }
}
