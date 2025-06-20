<?php

namespace App\Listeners;

use App\Events\ClassCancled;
use App\Jobs\NotifyClassCancelledClass;

class NotifyClassCanceld
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function handle(ClassCancled $event): void
    {
        $members = $event->scheduledClass->members();
        $className = $event->scheduledClass->classType()->name;
        $classDateTime = $event->scheduledClass->date_time;

        $details = compact('className', 'classDateTime');

        //        $members->each(function ($member) use ($details) {
        //            Mail::to($member)->send(new ClassCanceledMail($details));
        //        });

        NotifyClassCancelledClass::dispatch($members, $details);
    }
}
