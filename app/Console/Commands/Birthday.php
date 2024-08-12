<?php

namespace App\Console\Commands;

use App\Jobs\SendMail;
use App\Mail\HappyBirthdayMailable;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Birthday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'happybirthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();
        $users = User::whereMonth('dob', $today->month)->whereDay('dob', $today->day)->get();
        foreach($users as $user) {
            dispatch(new SendMail($user->email, new HappyBirthdayMailable($user)));
        }
    }
}
