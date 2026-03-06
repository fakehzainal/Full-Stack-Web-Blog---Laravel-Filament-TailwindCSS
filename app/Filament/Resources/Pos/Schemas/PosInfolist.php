<?php

namespace App\Filament\Resources\Pos\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PosInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Pos')
                    ->schema([
                        TextEntry::make('created_at')
                            ->dateTime('j M, Y'),
                        TextEntry::make('kategori.nama')
                            ->label('Kategori'),
                        TextEntry::make('judul')
                            ->columnSpanFull(),
                        TextEntry::make('konten')
                            ->columnSpanFull()
                            ->prose(),
                    ])->columnSpan(2)
                    ->columns(2),
                Section::make()
                    ->schema([
                        ImageEntry::make('thumbnail')
                            ->imageHeight(190)
                            ->disk('public'),
                    ])->columnSpan(1),

            ])->columns(3);
    }
}
