<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class KafshInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kashf:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install essential data to start';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('migrate:fresh', [
            '--seed' => true
        ]);
        DB::unprepared(file_get_contents('database/sql/drugs.sql'));
    }
}
