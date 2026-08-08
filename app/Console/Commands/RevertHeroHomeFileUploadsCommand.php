<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;

class RevertHeroHomeFileUploadsCommand extends Command
{
    protected $signature = 'pages:revert-hero-home-uploads';

    protected $description = 'Revert hero-home block FileUpload fields back to array format';

    public function handle()
    {
        $this->info('Reverting hero-home block FileUpload fields to array format...');

        $pages = Page::all();
        $fixed = 0;

        foreach ($pages as $page) {
            $updated = false;

            foreach (['en', 'ar'] as $locale) {
                $blocks = $page->getTranslation('blocks', $locale, false) ?? [];

                foreach ($blocks as $blockIndex => &$block) {
                    if (($block['type'] ?? null) === 'hero-home') {
                        $data = &$block['data'];

                        // Fields to revert
                        $fileFields = [
                            'background_image',
                            'promo_1_image',
                            'promo_1_pdf',
                            'promo_2_image',
                            'promo_2_pdf',
                        ];

                        foreach ($fileFields as $field) {
                            if (isset($data[$field]) && is_string($data[$field]) && !empty($data[$field])) {
                                // Convert string back to array format
                                $data[$field] = [$data[$field]];
                                $updated = true;
                                $this->info("  Reverted {$field} to array for page {$page->id} ({$locale})");
                            }
                        }
                    }
                }

                if ($updated) {
                    $page->setTranslation('blocks', $locale, $blocks);
                }
            }

            if ($updated) {
                $page->save();
                $fixed++;
            }
        }

        $this->info("\n✅ Reverted {$fixed} page(s)");

        $this->info("\nClearing caches...");
        $this->call('cache:clear');

        return Command::SUCCESS;
    }
}
