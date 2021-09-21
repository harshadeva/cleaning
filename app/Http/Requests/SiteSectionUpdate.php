<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class SiteSectionUpdate extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(["errorMessage" => $validator->errors()->first()], 200));
    }
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
            'site_id'=>'required',
            'site_sections'=>'array|min:1',
            'site_sections.*.employee_id'=>'required|numeric',
            'site_sections.*.section'=>'required',
        ];
    }

    public function attributes()
    {
        return [
        'site_id'=>'site',
        'site_sections'=>'site section',
            'site_sections.*.employee_id'=>'employee'
        ];
    }
}
