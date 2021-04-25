<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;

class SocialUpdateRequest extends ApiMasterRequest
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
            'facebook' => 'nullable|string|max:110',
            'twitter' => 'nullable|string|max:110',
            'insta' => 'nullable|string|max:110',
            'site' => 'nullable|string|max:110',
            'medium' => 'nullable|string|max:110',
        ];
    }
    
}
