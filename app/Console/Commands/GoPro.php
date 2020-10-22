<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GoPro extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'go:pro';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build for Production';

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
     * @return int
     */
    public function handle()
    {
        $proUrl = 'https://kashfwedawaa.com';
        $testUrl = 'http://kashfwedawaa.test';

        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'APP_URL=' . $testUrl,
                'APP_URL=' . $proUrl,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                'API_URL=' . $testUrl,
                'API_URL=' . $proUrl,
                file_get_contents($path)
            ));
        }
        exec('npm run build');

        file_put_contents($path, str_replace(
            'APP_URL=' . $proUrl,
            'APP_URL=' . $testUrl,
            file_get_contents($path)
        ));
        file_put_contents($path, str_replace(
            'API_URL=' . $proUrl,
            'API_URL=' . $testUrl,
            file_get_contents($path)
        ));

    }
}
