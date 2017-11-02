<?php

namespace App\Http\Requests;

use App\Services\Utilities\Year;
use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $subject_ids = $this->user->subjects_unique->pluck('id')->toArray();
        $subject_ids = implode(',', $subject_ids);

        $years = $this->user->teacher->teacherSubjects($this->subject_id)->pluck('pivot.year')->unique()->toArray();
        $years = implode(',', $years);

        switch ($this->method())
        {
            case 'POST':
                return [
                    'subject_id' => 'required|in:'.$subject_ids,
                    'year' => 'required|in:'.$years,
                    'title' => 'required',
                    'topic' => 'required',
                    'goals' => 'required',
                    'readings' => 'required',
                ];
                break;

            case 'PUT':
            case 'PATCH':
                return [
                    'subject_id' => 'required|in:'.$subject_ids,
                    'year' => 'required|in:'.$years,
                    'title' => 'required',
                    'topic' => 'required',
                    'goals' => 'required',
                    'readings' => 'required',
                ];
                break;
        }
    }
}