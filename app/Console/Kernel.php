<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;

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
        // \Log::info("Cron run");

        $start = setting('site.inicio_asignaciones');
        $end = setting('site.fin_asignaciones');


        if(setting('site.modo_asignacion_prospectos')!="no_asignar"){

            if(setting('site.modo_asignacion_prospectos')=="equirandom"){
                $prefix = "equi-";
            }else{
                $prefix= "";
            }

            $schedule->command($prefix.'distribute-leads')
                ->everyMinute()->between($start, $end);

        }

        if(setting('site.mode_reasign_leads')!="not_reassign"){

            if(setting('site.mode_reasign_leads')=="any_random_promotor"){
                $optionTo = "any_promotor";
            }else{
                $optionTo= "special_promotors_group";
            }

            $schedule->command('reasign-unfollowed-leads --seguimiento=1-2 --to='.$optionTo)
                ->everyMinute()->between($start, $end);

            $schedule->command('reasign-unfollowed-leads --seguimiento=2-3 --to='.$optionTo)
                ->everyMinute()->between($start, $end);

        }

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
