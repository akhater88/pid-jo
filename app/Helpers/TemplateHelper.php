<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Models\Service;

class TemplateHelper
{
    /**
     * Replace template variables with actual service data.
     *
     * @param  array<string, mixed>  $blockData
     * @param  Service  $service
     * @return array<string, mixed>
     */
    public static function replaceVariables(array $blockData, Service $service): array
    {
        $variables = [
            '{{service_title}}' => $service->title,
            '{{service_description}}' => $service->short_description ?? '',
            '{{service_body}}' => $service->body ?? '',
        ];

        return self::replaceInArray($blockData, $variables);
    }

    /**
     * Recursively replace variables in an array.
     *
     * @param  mixed  $data
     * @param  array<string, string>  $variables
     * @return mixed
     */
    private static function replaceInArray(mixed $data, array $variables): mixed
    {
        if (is_string($data)) {
            return str_replace(array_keys($variables), array_values($variables), $data);
        }

        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = self::replaceInArray($value, $variables);
            }
        }

        return $data;
    }
}
