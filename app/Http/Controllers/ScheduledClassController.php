<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduledClassValidationRequest;
use App\Models\ClassType;
use App\Models\ScheduledClass;

class ScheduledClassController extends Controller
{
    public function index()
    {
        return view('instructor.upcoming', [
            'scheduledClasses' => auth()->user()->scheduledClasses()->with('classType')->upcoming()->oldest('date_time')->get(),
        ]);
    }

    public function store(ScheduledClassValidationRequest $request)
    {
        ScheduledClass::create($request->validated());

        return redirect()->route('schedule.index');
    }

    public function create()
    {
        $classTypes = ClassType::all();

        return view('instructor.schedule')->with('classTypes', $classTypes);
    }

        public function destroy(ScheduledClass $schedule)
        {

            if (auth()->user()->cannot('delete', $schedule)) {
                abort(403);
            }

            ClassCanceled::dispatch($schedule);

            $schedule->members()->detach();
            $schedule->delete();

            return redirect()->route('schedule.index');
        }
}
