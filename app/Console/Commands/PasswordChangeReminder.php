<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Carbon\Carbon;
use Mail;
use App\Mail\PasswordChangeReminderEmail;

class PasswordChangeReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:password-change';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send password chage reminder to employee';

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
        $date = Carbon::now()->subDays(30)->toDateTimeString();

        $users = User::whereDate('password_updated_at', '<', $date)
                       ->where(function ($query) use ($date) {
                            $query->whereDate('reminder_at', '<', $date)
                                  ->orWhereNull('reminder_at');
                       })->get();

        foreach ($users as $user) {
              Mail::to($user->email)->queue(new PasswordChangeReminderEmail($user));

              $user->reminder_at = Carbon::now();
              $user->update();
        }
    }
}
