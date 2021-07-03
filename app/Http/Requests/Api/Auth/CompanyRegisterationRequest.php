<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;

class CompanyRegisterationRequest extends ApiMasterRequest
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
            'foundation_name' => 'required|string|max:110',
            'email' => 'required|email|max:90|unique:users',
            'password' => 'required|string|min:6|max:15',
            'country_id' => 'required|numeric|exists:countries,id',
            'city_id' => 'required|numeric|exists:cities,id',
            'hear_by_id' => 'required|numeric|exists:hear_bies,id',
            'major_id' => 'required|numeric|exists:majors,id',
            'working_type' => 'required|in:full_time,part_time,remotely',
            'commercial_file' => 'required',
            'address' => 'required',
            'description' => 'required',
            'members_count' => 'required|numeric',
        ];
    }

}
