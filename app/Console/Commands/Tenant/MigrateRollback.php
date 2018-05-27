<?php

namespace App\Console\Commands\Tenant;

use App\Company;
use App\Tenant\Database\DatabaseManager;
use App\Tenant\Traits\Console\AcceptsMultipleTenants;
use App\Tenant\Traits\Console\FetchesTenants;
use Illuminate\Database\Console\Migrations\RollbackCommand;
use Illuminate\Database\Migrations\Migrator;

class MigrateRollback extends RollbackCommand
{
    use FetchesTenants,AcceptsMultipleTenants;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback migrations for tenants';

    protected $db;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Migrator $migrator, DatabaseManager $db)
    {

        parent::__construct($migrator);
        $this->setName('tenants:rollback');

        $this->specifyParameters();

        $this->db = $db;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if(!$this->confirmToProceed()){
            return ;
        }

        $this->input->setOption('database','tenant');

        $this->tenants($this->option('tenants'))->each(function($tenant){
            $this->db->createConnection($tenant);
            $this->db->connectToTenant();
            parent::handle();
            $this->db->purge();
        });

    }

}
