<?php

namespace Database\Seeders;

use App\Models\ScheduledClass;
use Illuminate\Database\Seeder;

class ScheduledClassSeeder extends Seeder
{
    public function run(): void
    {
        ScheduledClass::factory()->count(10)->create();
    }
}
