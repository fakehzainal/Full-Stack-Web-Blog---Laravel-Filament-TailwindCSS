<?php

namespace App\Filament\Resources\Kategoris;

use App\Filament\Resources\Kategoris\Pages\CreateKategori;
use App\Filament\Resources\Kategoris\Pages\EditKategori;
use App\Filament\Resources\Kategoris\Pages\ListKategoris;
use App\Filament\Resources\Kategoris\Pages\ViewKategori;
use App\Filament\Resources\Kategoris\Schemas\KategoriForm;
use App\Filament\Resources\Kategoris\Schemas\KategoriInfolist;
use App\Filament\Resources\Kategoris\Tables\KategorisTable;
use App\Models\Kategori;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class KategoriResource extends Resource
{
    protected static ?string $model = Kategori::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|BackedEnum|null $activeNavigationIcon = 'heroicon-s-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Schema $schema): Schema
    {
        return KategoriForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return KategoriInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KategorisTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKategoris::route('/'),
            //'create' => CreateKategori::route('/create'),
            //'view' => ViewKategori::route('/{record}'),
            //'edit' => EditKategori::route('/{record}/edit'),
        ];
    }

    protected static function user(): ?User
    {
        $user = auth()->user();

        return $user instanceof User ? $user : null;
    }

    public static function canViewAny(): bool
    {
        return static::user()?->isAdmin() === true;
    }

    public static function canCreate(): bool
    {
        return static::user()?->isAdmin() === true;
    }

    public static function canEdit(Model $record): bool
    {
        return static::user()?->isAdmin() === true;
    }

    public static function canDelete(Model $record): bool
    {
        return static::user()?->isAdmin() === true;
    }

    public static function canDeleteAny(): bool
    {
        return static::user()?->isAdmin() === true;
    }
}
