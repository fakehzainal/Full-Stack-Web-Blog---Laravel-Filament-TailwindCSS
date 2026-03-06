<?php

namespace App\Filament\Resources\Pos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class PosForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Pos')
                    ->schema([
                        TextInput::make('judul')
                            ->columnSpanFull()
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->required()
                            ->alphaDash()
                            ->unique(ignoreRecord: true),
                        Select::make('kategori_id')
                            ->relationship('kategori', 'nama')
                            ->preload()
                            ->searchable()
                            ->required(),
                        RichEditor::make('konten')
                            ->columnSpanFull()
                            ->required(),
                    ])->columnSpan(2)
                    ->columns(2),
                Section::make('Upload Thumbnail')
                    ->schema([
                        FileUpload::make('thumbnail')
                            ->hiddenLabel()
                            ->disk('public')
                            ->image()
                            ->imagePreviewHeight('180')
                    ])->columnSpan(1),
            ])->columns(3);
    }
}
