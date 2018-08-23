<?php

namespace App\Console;

use App\Transaction;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->call(function (){
             $date = date('Y-m-d', mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")));
             $summ_transaction = \App\Transaction::where('date', $date)
                 ->sum('amount');
             \App\DailyTransaction::create([
                 'date'=>$date,
                 'amount'=>$summ_transaction,
             ]);

         })->daily();


         $schedule->call(function (){})->cron('47 23 1/2 * * *');

        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
