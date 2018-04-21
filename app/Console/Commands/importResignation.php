<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Traits\BatchImport;
use App\Resignation;

class importResignation extends Command
{
    use BatchImport;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch_import:resignation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Tender Resignation';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->path = '/var/www/html/accendo/sps_import/';
        $this->filename = 'resignation.txt';
        $this->delimiter = ';';
        $this->date_field = ['trx_date'];
        $this->date_format = 'Ymd';
        $this->fixed_length_field = [
            'header' => ['header' => 1, 'trx_date' => 8],
            'data' => ['detail' => 1, 
                    'company_code' => 3,
                    'person_id' => 5,
                    'name' => 40,
                    'tender_flag' => 1,
                    ],
            'footer' => ['trailer' => 1, 'record_count' => 6]
        ];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $resignation = new Resignation();
        $this->importFixedLength($resignation);
    }
}
