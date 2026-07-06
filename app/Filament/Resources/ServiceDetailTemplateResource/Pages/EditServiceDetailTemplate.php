<?php

namespace App\Filament\Resources\ServiceDetailTemplateResource\Pages;

use App\Filament\Resources\ServiceDetailTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceDetailTemplate extends EditRecord
{
    protected static string $resource = ServiceDetailTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
