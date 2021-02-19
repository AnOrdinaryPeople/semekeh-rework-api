<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\CacheCommand::class,
        \App\Console\Commands\ClearHistoryCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function(){
            \Illuminate\Support\Facades\Artisan::call('history:clear');
            \Illuminate\Support\Facades\Artisan::call('cache:refresh', [
                'token' => 'dQw4w9WgXcQ'
            ]);
        })->monthly();
    }
}
