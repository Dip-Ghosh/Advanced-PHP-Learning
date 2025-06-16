<?php

namespace App\Jobs;

use App\Mail\ClassCanceledMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class NotifyClassCancelledClass implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(public $members, public array $details)
    {
        //
    }

    public function handle(): void
    {
        Notification::send($this->members, new ClassCanceledMail($this->details));
    }
}
