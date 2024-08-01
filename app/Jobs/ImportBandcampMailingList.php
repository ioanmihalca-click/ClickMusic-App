<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Log;

class ImportBandcampMailingList implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
{
    $filePath = storage_path('app/mailing_list.xml');
    Log::info('Starting import process');
    Log::info('XML file path: ' . $filePath);

    try {
        $xmlData = simplexml_load_file($filePath);
        Log::info('XML file loaded successfully');
        Log::info('Number of subscribers found: ' . count($xmlData->subscriber));

        $importedCount = 0;
        foreach ($xmlData->subscriber as $subscriber) {
            $emailAddress = (string) $subscriber->recipient_email;
            $name = (string) $subscriber->recipient_name;

            if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
                Log::warning("Invalid email address in XML: {$emailAddress}");
                continue;
            }

            if (Newsletter::where('recipient_email', $emailAddress)->exists()) {
                Log::info("Duplicate email address in XML: {$emailAddress}. Skipping.");
                continue; 
            }

            Newsletter::create([
                'recipient_email' => $emailAddress,
                'recipient_name' => $name,
                'status' => 'pending', 
            ]);
            $importedCount++;
        }

        Log::info('Import completed. Total records imported: ' . $importedCount);

    } catch (\Exception $e) {
        Log::error('Error importing Bandcamp mailing list: ' . $e->getMessage());
        Log::error($e->getTraceAsString());
    }
}
}
