<?php

namespace App\Filament\Widgets;

use App\Models\Album;
use App\Models\Post;
use App\Models\User;
use App\Models\Video;
use App\Models\Newsletter;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;

class StatsOverview extends BaseStatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
            ->color('primary')
            ->icon('heroicon-o-users'),
            Stat::make('Newsletter Subscribers', Newsletter::count())
            ->color('info') 
            ->icon('heroicon-o-envelope'),
            Stat::make('Total Blog Posts', Post::count())
                ->color('primary') 
                ->icon('heroicon-o-document-text'),
            Stat::make('Total Videos', Video::count())
            ->color('success')
            ->icon('heroicon-o-film'),
            Stat::make('Albume in Magazin', Album::count())
                ->color('success') 
                ->icon('heroicon-o-musical-note'), 
            Stat::make('Most Active User', function () {
                return User::withCount('comments') 
                    ->orderBy('comments_count', 'desc')
                    ->first()?->name ?? 'N/A';
            }),

            // ... add more stats as needed ...
        ];
    }
}
