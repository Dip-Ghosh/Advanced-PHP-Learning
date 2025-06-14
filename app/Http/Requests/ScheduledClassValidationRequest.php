<?php

namespace App\Http\Requests;

use App\Rules\DateTimeCombine;
use Illuminate\Foundation\Http\FormRequest;

class ScheduledClassValidationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'class_type_id' => ['required', 'exists:class_types,id'],
            'date_time'     => ['required', 'date', 'after:now', 'unique:scheduled_classes,date_time'],
            'instructor_id' => ['required', 'exists:users,id']
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('date') && $this->filled('time')) {
            $this->merge([
                             'date_time' => "{$this->input('date')} {$this->input('time')}",
                             'instructor_id' => auth()->id(),
                         ]);
        }
    }

}

