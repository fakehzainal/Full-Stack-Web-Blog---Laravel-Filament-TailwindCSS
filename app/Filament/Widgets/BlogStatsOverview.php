<?php

namespace App\Filament\Widgets;

use App\Models\Kategori;
use App\Models\Pos;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BlogStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;
    protected int | array | null $columns = 2;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Pos', number_format(Pos::query()->count()))
                ->description('Jumlah seluruh artikel')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success'),

            Stat::make('Total Kategori', number_format(Kategori::query()->count()))
                ->description('Jumlah kategori tersedia')
                ->descriptionIcon('heroicon-m-tag')
                ->color('primary'),
        ];
    }
}
