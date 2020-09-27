<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		//
		'App\Console\Commands\ExamNotice',
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule) {
		$schedule->command('ExamNotification:cron')->daily();
		//$schedule->command('ExamNotification:cron')->weekly()->saturdays()->at('20:25');
		//$schedule->command('inspire')->weekly()->saturdays()->at('22:58');
		//$schedule->command('ExamNotification:cron')->dailyAt('22:44');
	}

	/**
	 * Register the Closure based commands for the application.
	 *
	 * @return void
	 */
	protected function commands() {
		//$this->load(__DIR__.'/Commands');
		require base_path('routes/console.php');
	}
}
