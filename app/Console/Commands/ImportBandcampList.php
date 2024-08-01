<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ImportBandcampMailingList;

class ImportBandcampList extends Command
{
    protected $signature = 'import:bandcamp-list';

    protected $description = 'Import Bandcamp mailing list from XML file';

    public function handle()
    {
        $this->info('Dispatching ImportBandcampMailingList job...');
        ImportBandcampMailingList::dispatch();
        $this->info('Job dispatched successfully!');
    }
}