<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ReportStoreRequest extends FormRequest
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
            'site_id' => 'required',
            'date' => 'required|date'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            if ($validator->errors()->count() > 0) {
                return;
            }

            $sections = $this->site_sections;
            foreach ($sections as $section) {
                $collection = collect($sections);
                if (!isset($section['section_id']) || $section['section_id']  == null) {
                    return $validator->errors()->add('section_id', "Please select section");
                }
                if (!isset($section['employee_id']) || $section['section_id']  == null) {
                    return $validator->errors()->add('employee_id', "Please select employee");
                }
                $exists = $collection->where('section_id', $section['section_id'])->where('employee_id', $section['employee_id'])->count();
                if ($exists > 1) {
                    return $validator->errors()->add('employee_id', "Employee has repeated in same section");
                }
            }
        });
    }
}
