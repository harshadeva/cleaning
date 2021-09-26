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
            'signature_id' => 'required|exists:media,id',
            'date' => 'required|date',
            'site_sections'=>'array|required|min:1',
            'site_sections.*.section_name'=>'required',
            'site_sections.*.rating'=>'required|numeric|min:0|max:10',
            'site_sections.*.employee_id'=>'required|numeric',
            'site_sections.*.remark'=>'nullable|max:2500',
        ];
    }

    // public function withValidator($validator)
    // {
    //     $validator->after(function ($validator) {

    //         if ($validator->errors()->count() > 0) {
    //             return;
    //         }

    //         $sections = $this->site_sections;
    //         foreach ($sections as $section) {
    //             $collection = collect($sections);
    //             if (!isset($section['employee_id']) || $section['section_id']  == null) {
    //                 return $validator->errors()->add('employee_id', "Please select employee");
    //             }
    //             // $exists = $collection->where('section_id', $section['section_id'])->where('employee_id', $section['employee_id'])->count();
    //             // if ($exists > 1) {
    //             //     return $validator->errors()->add('employee_id', "Employee has repeated in same section");
    //             // }
    //         }
    //     });
    // }

    public function attributes(){
        return [
            'signature_id'=> 'signature',
            'site_sections.*.section_name'=> 'section name',
            'site_sections.*.rating'=> 'rating',
            'site_sections.*.employee_id'=> 'employee',
            'site_sections.*.remark'=> 'remark',
        ];
    }
}
