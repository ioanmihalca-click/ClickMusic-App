<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\PromoEmail;
use Illuminate\Console\Command;

class ResetPromoEmailStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-promo-email-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset status de trimitere PromoEmail';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Găsește email-urile trimise cu mai mult de 24 de ore în urmă
        $emails = PromoEmail::where('status', 'sent')
            ->where('sent_at', '<', Carbon::now()->subHours(24))
            ->get();

        // Resetează statusul la 'pending'
        foreach ($emails as $email) {
            $email->update(['status' => 'pending']);
        }

        $this->info('Statusul email-urilor a fost resetat cu succes.');
    }
}
