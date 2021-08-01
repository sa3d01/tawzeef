<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;

class ExperienceUpdateRequest extends ApiMasterRequest
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
        return [
            'experience_years'=>'nullable|string|max:110',
            'job_title'=>'nullable|string|max:110',
            'major_id' => 'required|numeric|exists:majors,id',
            'foundation_major_id' => 'required|numeric|exists:majors,id',
            'country_id' => 'required|numeric|exists:countries,id',
            'job_description' => 'nullable|string|max:500',
            'start_date' => 'required|date|before:today',
            'end_date' => 'nullable|date|after:start_date|before:today',
            'foundation_name' => 'required|string|max:110',
            'foundation_members_count' => 'nullable|string|max:110',
            'latest_salary' => 'nullable',
        ];
    }

}
