<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\RemindMemberNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class RemindMembers extends Command
{
    protected $signature = 'app:remind-members';
    protected $description = 'Remind Member description';

    public function handle()
    {
        $members = User::where('role', 'member')->whereDoesntHave('bookings', function ($query) {
            $query->where('date_time', '>', now());
        })->select(['id', 'email'])->get();

        Notification::send($members, new RemindMemberNotification());
    }
}
