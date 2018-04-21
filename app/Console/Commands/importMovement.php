<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Traits\BatchImport;
use App\Movement;

class importMovement extends Command
{
    use BatchImport;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch_import:movement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Movement';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->path = '/var/www/html/accendo/sps_import/';
        $this->filename = 'movement.txt';
        $this->delimiter = ';';
        $this->date_field = ['trx_date','effective_date'];
        $this->date_format = 'Ymd';
        $this->fixed_length_field = [
            'header' => ['header' => 1, 'trx_date' => 8],
            'data' => [
                    'detail' => 1, 
                    'company_code' => 6,
                        'filler_1' => 1,
                    'staff_no' => 10,
                        'filler_2' => 1,
                    'name' => 60,
                        'filler_3' => 1,
                    'branch_dept_div_code' => 6,
                        'filler_4' => 1,
                    'profit_cost_code' => 7,
                        'filler_5' => 1,
                    'designation_code' => 4,
                        'filler_6' => 1,
                    'effective_date' => 10,
                        'filler_7' => 1,
                    'movement_code' => 20,
                        'filler_8' => 1,
                    'movement_desc' => 50,
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
        $movement = new Movement();
        $this->importFixedLength($movement);
    }
}
