<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Traits\BatchImport;
use App\WorkingExperience;

class importExperience extends Command
{

    use BatchImport;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch_import:experience';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Working Experience';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->path = '/var/www/html/accendo/sps_import/';
        $this->filename = 'experience.txt';
        $this->delimiter = ';';
        $this->date_field = ['effective_date'];
        $this->date_format = 'd/m/Y';
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $experience = new WorkingExperience();
        $this->importCSV($experience);
    }
}
