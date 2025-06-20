<?php

namespace Tests\Feature;

use App\Models\ClassType;
use App\Models\User;
use Database\Seeders\ClassTypeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InstructiorTest extends TestCase
{
    use RefreshDatabase;

    public function test_instructor_is_redirected_to_instructor_dashboard(): void
    {
        $user = User::factory()->create([
                                            'role' => 'instructor',
                                        ]);

        $response = $this->actingAs($user)->get('/dashboard/instructor');

        $response->assertRedirectToRoute('dashboard.instructor');

        $this->followRedirects($response)->assertSee('Hey Instructor');
    }

    public function test_instructor_can_schedule_a_class()
    {
        //given
        $user = User::factory()->create([
                                            'role' => 'instructor',
                                        ]);

        $this->seed(ClassTypeSeeder::class);

        //when
        $response = $this->actingAs($user)
                         ->post('instructor/schedule', [
                             'class_type_id' => ClassType::first()->id,
                             'date'          => '2019-01-01',
                             'time'          => '08:00',
                         ])
        ;

        $this->assertDatabaseHas('scheduled_classes', [
            'class_type_id' => ClassType::first()->id,
            'date_time'     => '2019-01-01 08:00',
        ]);

        //then
        $response->assertRedirect('instructor/schedule');
    }

    public function test_delete_a_class()
    {
        $user = User::factory()->create([
                                            'role' => 'instructor',
                                        ]);

        $this->seed(ClassTypeSeeder::class);

        //when
        $response = $this->actingAs($user)
                         ->post('instructor/schedule', [
                             'class_type_id' => ClassType::first()->id,
                             'date'          => '2019-01-01',
                             'time'          => '08:00',
                         ])
        ;
    }

    public function test_instructor_is_redirected_to_instructor_dashboard()
    {
        $user     = User::factory()->create(['role' => 'instructor']);
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertRedirectToRoute('instructor.dashboard');
        $this->followRedirects($response)->assertSeeText("Hey Instructor");
    }
}
