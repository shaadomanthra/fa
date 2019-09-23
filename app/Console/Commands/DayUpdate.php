<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

use App\Models\Test\Writing;
use App\Mail\reviewnotify;
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
        $first = Writing::where('notify','!=',0)->first();
        $first->notify=0;
        $first->status = 1;
        $first->save();
        
       $writings = Writing::where('notify','!=',0)->get();

       foreach($writing as $w){
            $h = date('H');
            if($w->notify==$h)
            {
                $test = $w->attempt->test;
                $user = $w->user;
                Mail::to($user->email)->send(new reviewnotify($user,$test));
                $w->notify = 0;
                $w->status = 1;
                $w->save();
                $this->info('Hourly Update has been send successfully');
            }
       }
       
    }
}
