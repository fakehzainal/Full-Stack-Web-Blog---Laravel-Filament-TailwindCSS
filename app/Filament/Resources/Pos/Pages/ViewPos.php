<?php

namespace App\Filament\Resources\Pos\Pages;

use App\Filament\Resources\Pos\PosResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPos extends ViewRecord
{
    protected static string $resource = PosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
