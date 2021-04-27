<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;

class QulificationUpdateRequest extends ApiMasterRequest
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
            'qualification_type' => 'required|in:secondary,diploma,bachelor,ma,phd',
            'foundation_name' => 'required|string|max:110',
            'country_id' => 'required|numeric|exists:countries,id',
            'city_id' => 'required|numeric|exists:cities,id',
            'average_calculation_system'=>'required|string|max:110',
            'graduation_date' => 'required|date',
            'graduation_degree' => 'nullable',
            'specialization'=>'required|string|max:110',
            'graduation_file' => 'nullable',
        ];
    }

}
