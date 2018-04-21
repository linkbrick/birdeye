<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Traits\BatchImport;
use App\Holiday;

class importHoliday extends Command
{
    use BatchImport;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch_import:holiday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Holiday File';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->path = '/var/www/html/accendo/sps_import/';
        $this->filename = 'holiday.txt';
        $this->delimiter = ';';
        $this->date_field = ['off_date','holiday_date'];
        $this->date_format = 'd/m/Y';
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $holiday = new Holiday();
        $this->importCSV($holiday);
    }
}
