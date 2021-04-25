<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;

class UserRegisterationRequest extends ApiMasterRequest
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
            'first_name' => 'required|string|max:110',
            'last_name' => 'required|string|max:110',
            'email' => 'required|email|max:90|unique:users',
            'password' => 'required|string|min:6|max:15',
            'country_id' => 'required|numeric|exists:countries,id',
            'city_id' => 'required|numeric|exists:cities,id',
            'major_id' => 'required|numeric|exists:majors,id',
            'job_title' => 'required',
            'hear_by' => 'required|in:friend,ad,social,google',
            'cv' => 'required',
        ];
    }
}
