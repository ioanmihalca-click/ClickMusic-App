<?php

namespace App\Filament\Resources\NewsletterSubscriberResource\Pages;

use App\Models\User;
use App\Models\Newsletter;
use Filament\Actions\CreateAction;
use Illuminate\Support\HtmlString;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use App\Filament\Resources\NewsletterSubscriberResource;

class ListNewsletterSubscribers extends ListRecords
{
    protected static string $resource = NewsletterSubscriberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('stats')
                ->label('Statistici')
                ->icon('heroicon-o-chart-bar')
                ->color('success')
                ->action(fn() => null)
                ->modalContent(function (): HtmlString {
                    // Preluăm statisticile
                    $stats = $this->getSubscriberStats();

                    // HTML pentru afișarea statisticilor
                    $html = '
                    <div class="space-y-4 p-3">
                        <h2 class="text-lg font-bold">Statistici abonați newsletter</h2>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Abonați din conturile utilizatorilor</p>
                                <p class="text-2xl font-bold">' . $stats['userSubscribers'] . '</p>
                            </div>
                            
                            <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Abonați din formular newsletter</p>
                                <p class="text-2xl font-bold">' . $stats['newsletterSubscribers'] . '</p>
                            </div>
                        </div>
                        
                        <div class="bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 rounded-lg p-4">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Total abonați unici</p>
                            <p class="text-3xl font-bold text-green-600 dark:text-green-400">' . $stats['totalUnique'] . '</p>
                        </div>
                        
                        <div class="border-t pt-3 dark:border-gray-700">
                            <p class="text-xs text-gray-500">* Statisticile exclud adresele duplicate între cele două surse</p>
                        </div>
                    </div>';

                    return new HtmlString($html);
                }),
        ];
    }

    /**
     * Calculează statisticile pentru abonați
     */
    private function getSubscriberStats(): array
    {
        $newsletterSubscribers = Newsletter::subscribers()->count();
        $userSubscribers = User::newsletterSubscribed()->count();

        // Calculăm duplicatele (email-uri care apar în ambele tabele)
        $newsletterEmails = Newsletter::subscribers()->pluck('recipient_email')->toArray();
        $duplicateUsers = User::whereIn('email', $newsletterEmails)
            ->newsletterSubscribed()
            ->count();

        return [
            'newsletterSubscribers' => $newsletterSubscribers,
            'userSubscribers' => $userSubscribers,
            'duplicates' => $duplicateUsers,
            'totalUnique' => $newsletterSubscribers + $userSubscribers - $duplicateUsers,
        ];
    }
}
