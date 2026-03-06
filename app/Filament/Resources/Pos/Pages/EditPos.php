<?php

namespace App\Filament\Resources\Pos\Pages;

use App\Filament\Resources\Pos\PosResource;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPos extends EditRecord
{
    protected static string $resource = PosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()
                ->visible(fn (): bool => auth()->user() instanceof User && auth()->user()->isAdmin()),
            DeleteAction::make()
                ->visible(fn (): bool => auth()->user() instanceof User && auth()->user()->isAdmin()),
        ];
    }
}
