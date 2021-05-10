<?php

namespace App\Http\Requests\Api;

class JobStoreRequest extends ApiMasterRequest
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
            'major_id' => 'required|numeric|exists:majors,id',
            'job_title' => 'required',
            'qualification_type' => 'required|in:secondary,diploma,bachelor,ma,phd',
            'level' => 'required|in:fresh_graduate,average,high',
            'working_type' => 'required|in:full_time,part_time,remotely',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'sex' => 'nullable|in:male,female',
            'experience_years'=>'nullable|string|max:110',
            'expected_salary'=>'nullable|string|max:110',
            'country_id' => 'required|numeric|exists:countries,id',
            'city_id' => 'required|numeric|exists:cities,id',
            'description'=>'required',
            'location.lat'=>'nullable',
            'location.lng'=>'nullable',
            'show_company'=>'nullable',
            'pay_type'=>'required|in:bank,online',
            'invoice_image'=>'nullable',
        ];
    }
}
