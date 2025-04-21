<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TaskCounterStatistik extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:counter-statistik';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert date daily in table counter';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow   = Carbon::now()->addDay();
        $date       = $tomorrow->toDateString();
        
        DB::table('statistik')->insert(['tanggal' => $date]);
        Log::info('Task scheduler: Insert date '.$date.' in table counter: ');
    }
}
