<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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

        return [
            'title' => 'required|max:70',
            'description' => 'required|min:5|max:150',
            'subject_id' => 'required|in:'.$subject_ids,
            'classroom_id' => 'required',
            'start' => 'required|date_format:Y-m-d H:i|after_or_equal:today',
            'end' => 'required|date_format:Y-m-d H:i|before_or_equal:'.maxDate(),
        ];
    }
}