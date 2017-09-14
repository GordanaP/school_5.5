<?php

namespace App\Http\Requests;

use App\Services\Utilities\Year;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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

        $years = implode(',', array_keys(Year::all()));

        switch ($this->method())
        {
            case 'POST':
                return [
                    'subject_id' => 'required|in:'.$subject_ids,
                    'year' => 'required|in:'.$years,
                    'title' =>[
                        'required',
                        'alpha_num_spaces',
                        'max:80',
                        Rule::unique('lessons')->where(function ($query) {
                            $query->where('teacher_id', $this->user->teacher->id);
                        }),
                    ],
                    'topic' => 'nullable|alpha_num_spaces|max:150',
                    'goals' => 'nullable|alpha_num_spaces|max:300',
                    'readings.*' => 'sometimes|required|distinct|max:255',
                ];
                break;

            case 'PUT':
            case 'PATCH':
                return [
                    'subject_id' => 'required|in:'.$subject_ids,
                    'year' => 'required|in:'.$years,
                    'title' =>[
                        'required',
                        'alpha_num_spaces',
                        'max:80',
                        Rule::unique('lessons')->where(function ($query) {
                            $query->where('teacher_id', $this->user->teacher->id);
                        })->ignore($this->user->teacher->id, 'teacher_id'),
                    ],
                    'topic' => 'nullable|alpha_num_spaces|max:150',
                    'goals' => 'nullable|alpha_num_spaces|max:300',
                    'readings.*' => 'sometimes|required|distinct|max:255',
                ];
                break;
        }
    }

    public function messages()
    {
        $messages = [];

        if ($this->readings)
        {
            foreach($this->readings as $key => $val)
            {
                $messages['readings.'.$key.'.max'] = 'The :attribute must be less than :max characters long.';
            }
        }

        return $messages;
    }

}
