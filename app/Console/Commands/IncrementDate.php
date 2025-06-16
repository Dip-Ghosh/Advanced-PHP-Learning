<?php

namespace App\Console\Commands;

use App\Models\ScheduledClass;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class IncrementDate extends Command
{
    protected $signature = 'increment:date {--days=1}';

    protected $description = 'Increment all the scheduled classes date.';

    public function handle()
    {
        $days = $this->option('days');
        $scheduledClassIds = ScheduledClass::latest('date_time')->pluck('id')->toArray();

        DB::table('scheduled_classes')
            ->whereIn('id', $scheduledClassIds)
            ->update([
                'date_time' => DB::raw("DATE_ADD(date_time, INTERVAL {$days} DAY)"),
            ]);
    }
}
