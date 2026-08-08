<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;

class DiagnoseHeroHomeDataCommand extends Command
{
    protected $signature = 'pages:diagnose-hero-home';

    protected $description = 'Diagnose hero-home block data format';

    public function handle()
    {
        $this->info('Diagnosing hero-home block data...');
        $this->newLine();

        $pages = Page::all();

        foreach ($pages as $page) {
            $this->info("Page ID: {$page->id} - Title: " . $page->getTranslation('title', 'en'));

            foreach (['en', 'ar'] as $locale) {
                $blocks = $page->getTranslation('blocks', $locale, false) ?? [];

                foreach ($blocks as $blockIndex => $block) {
                    if (($block['type'] ?? null) === 'hero-home') {
                        $this->info("  [{$locale}] Found hero-home block");

                        $data = $block['data'] ?? [];

                        $fileFields = [
                            'background_image',
                            'promo_1_image',
                            'promo_1_pdf',
                            'promo_2_image',
                            'promo_2_pdf',
                        ];

                        foreach ($fileFields as $field) {
                            if (isset($data[$field])) {
                                $value = $data[$field];
                                $type = gettype($value);

                                if (is_array($value)) {
                                    $this->warn("    {$field}: ARRAY - " . json_encode($value));
                                } elseif (is_string($value)) {
                                    $this->line("    {$field}: STRING - {$value}");
                                } else {
                                    $this->error("    {$field}: {$type} - " . var_export($value, true));
                                }
                            } else {
                                $this->comment("    {$field}: NULL/NOT SET");
                            }
                        }
                        $this->newLine();
                    }
                }
            }
        }

        return Command::SUCCESS;
    }
}
