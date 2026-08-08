<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;

class FixAboutPageSlugCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pages:fix-about-slug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix the About page Arabic slug to match English slug';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Searching for About page...');

        // Find the about page by English slug
        $page = Page::query()
            ->whereJsonContains('slug->en', 'about')
            ->first();

        if (! $page) {
            $this->error('About page not found!');
            return Command::FAILURE;
        }

        $this->info("Found page: {$page->getTranslation('title', 'en')} (ID: {$page->id})");

        $currentArSlug = $page->getTranslation('slug', 'ar');
        $this->info("Current Arabic slug: {$currentArSlug}");

        if ($currentArSlug === 'about') {
            $this->info('✅ Arabic slug is already correct!');
            return Command::SUCCESS;
        }

        // Update Arabic slug to match English
        $page->setTranslation('slug', 'ar', 'about');
        $page->save();

        $this->info('✓ Updated Arabic slug to: about');
        $this->newLine();

        // Clear caches
        $this->info('Clearing caches...');
        $this->call('cache:clear');

        $this->newLine();
        $this->info('✅ About page slug fixed successfully!');
        $this->info('Arabic page is now accessible at: /ar/about');

        return Command::SUCCESS;
    }
}
