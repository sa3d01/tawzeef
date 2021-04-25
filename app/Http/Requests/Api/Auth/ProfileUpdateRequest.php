<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;

class ProfileUpdateRequest extends ApiMasterRequest
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
            'birthdate' => 'required|date',
            'sex' => 'required|in:male,female',
            'nationality_id' => 'required|numeric|exists:countries,id',
            'country_id' => 'required|numeric|exists:countries,id',
            'city_id' => 'required|numeric|exists:cities,id',
            'social_status' => 'required|in:single,married',
            'members_count' => 'nullable|numeric',
            'drive_licence_nationality_id' => 'nullable|numeric|exists:countries,id',
        ];
    }
    
}
