<?php

namespace App\Filament\Resources\ServiceDetailTemplateResource\Pages;

use App\Filament\Resources\ServiceDetailTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceDetailTemplates extends ListRecords
{
    protected static string $resource = ServiceDetailTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
