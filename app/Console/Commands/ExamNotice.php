<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExamNotice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ExamNotification:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Half yearly exam notice';

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
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $from = "developer.kaif@gmail.com";
        $to = "sibo.sarso@gmail.com";
        $subject = "PHP Mail Test script";
        $message = "This is a test to check the cron jobs functionality";
        $headers = "From:" . $from;
        mail($to,$subject,$message, $headers);
        echo "Test email sent PCS";exit;
    }
}
