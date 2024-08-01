<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Video;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseStatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
            ->color('primary')
            ->icon('heroicon-o-users'),
        Stat::make('Total Videos', Video::count())
            ->color('success')
            ->icon('heroicon-o-film'),
            Stat::make('Most Active User', function () {
                return User::withCount('comments') // Assuming you have a 'comments' relationship on the User model
                    ->orderBy('comments_count', 'desc')
                    ->first()?->name ?? 'N/A';
            }),
            // ... add more stats as needed ...
        ];
    }
}
