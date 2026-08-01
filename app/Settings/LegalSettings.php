<?php

declare(strict_types=1);

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class LegalSettings extends Settings
{
    /** @var array<string, string> */
    public array $terms_title;

    /** @var array<string, string> */
    public array $terms_content;

    /** @var array<string, string> */
    public array $privacy_title;

    /** @var array<string, string> */
    public array $privacy_content;

    public static function group(): string
    {
        return 'legal';
    }
}
