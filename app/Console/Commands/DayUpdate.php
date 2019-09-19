<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class DayUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'day:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail once in a day';

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
       $user = User::where('email','packetcode@gmail.com')->first();
       Mail::to($user->email)->send(new WelcomeMail($user));
       $this->info('Hourly Update has been send successfully');
    }
}
