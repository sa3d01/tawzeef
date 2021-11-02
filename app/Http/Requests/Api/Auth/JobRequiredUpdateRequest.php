<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;

class JobRequiredUpdateRequest extends ApiMasterRequest
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
            'job_title'=>'nullable|string|max:110',
            'job_role_title'=>'nullable|string|max:110',
            'level' => 'required|in:fresh_graduate,average,high',
            'major_id' => 'required|numeric|exists:majors,id',
            'country_id' => 'required|numeric|exists:countries,id',
            'expected_salary' => 'required|string|max:110',
            'job_target' => 'nullable|string|max:500',
            'notice_period' => 'required|string|max:110',
            'working_type' => 'required|in:full_time,part_time,remotely',
        ];
    }

}
