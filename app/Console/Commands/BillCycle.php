<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BillCycle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new:billcycle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start new Bill Cycle';

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
        foreach(\App\Models\BillCycle::all() as $billCycle) {
            if ($billCycle->status == 1) {
                $billCycle->update([
                    'status' => 0
                ]);
            }
        }
        \App\Models\BillCycle::create([
            'from' => now(),
            'to' => now()->addDays(env('BILL_CYCLE_DAYS')),
            'status' => 1
        ]);

        // TODO send a notification email to admin
    }
}
