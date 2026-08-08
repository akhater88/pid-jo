<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;

class FixHeroHomeFileUploadsCommand extends Command
{
    protected $signature = 'pages:fix-hero-home-uploads';

    protected $description = 'Fix hero-home block FileUpload fields to convert arrays to strings';

    public function handle()
    {
        $this->info('Fixing hero-home block FileUpload fields...');

        $pages = Page::all();
        $fixed = 0;

        foreach ($pages as $page) {
            $updated = false;

            foreach (['en', 'ar'] as $locale) {
                $blocks = $page->getTranslation('blocks', $locale, false) ?? [];

                foreach ($blocks as $blockIndex => &$block) {
                    if (($block['type'] ?? null) === 'hero-home') {
                        $data = &$block['data'];

                        // Fields to fix
                        $fileFields = [
                            'background_image',
                            'promo_1_image',
                            'promo_1_pdf',
                            'promo_2_image',
                            'promo_2_pdf',
                        ];

                        foreach ($fileFields as $field) {
                            if (isset($data[$field]) && is_array($data[$field])) {
                                // Extract the first value from the array
                                $data[$field] = $data[$field][0] ?? null;
                                $updated = true;
                                $this->info("  Fixed {$field} for page {$page->id} ({$locale})");
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

        $this->info("\n✅ Fixed {$fixed} page(s)");

        $this->info("\nClearing caches...");
        $this->call('cache:clear');

        return Command::SUCCESS;
    }
}
