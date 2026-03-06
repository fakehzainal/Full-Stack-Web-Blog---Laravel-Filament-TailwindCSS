<?php

namespace App\Filament\Resources\Pos;

use App\Filament\Resources\Pos\Pages\CreatePos;
use App\Filament\Resources\Pos\Pages\EditPos;
use App\Filament\Resources\Pos\Pages\ListPos;
use App\Filament\Resources\Pos\Pages\ViewPos;
use App\Filament\Resources\Pos\Schemas\PosForm;
use App\Filament\Resources\Pos\Schemas\PosInfolist;
use App\Filament\Resources\Pos\Tables\PosTable;
use App\Models\Pos;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PosResource extends Resource
{
    protected static ?string $model = Pos::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;
    protected static string|BackedEnum|null $activeNavigationIcon = 'heroicon-s-newspaper';

    protected static ?string $recordTitleAttribute = 'judul';

    public static function form(Schema $schema): Schema
    {
        return PosForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PosInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PosTable::configure($table);
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
            'index' => ListPos::route('/'),
            'create' => CreatePos::route('/create'),
            'view' => ViewPos::route('/{record}'),
            'edit' => EditPos::route('/{record}/edit'),
        ];
    }

    protected static function user(): ?User
    {
        $user = auth()->user();

        return $user instanceof User ? $user : null;
    }

    public static function canViewAny(): bool
    {
        return in_array(static::user()?->role, [User::ROLE_ADMIN, User::ROLE_PENULIS], true);
    }

    public static function canCreate(): bool
    {
        return in_array(static::user()?->role, [User::ROLE_ADMIN, User::ROLE_PENULIS], true);
    }

    public static function canEdit(Model $record): bool
    {
        return in_array(static::user()?->role, [User::ROLE_ADMIN, User::ROLE_PENULIS], true);
    }

    public static function canView(Model $record): bool
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
