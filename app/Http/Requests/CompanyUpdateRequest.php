<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'company_name' => 'required|max:200',
            'first_name' => 'required|max:100',
            'contact_no_1' => 'nullable|max:12',
            'contact_no_2' => 'nullable|max:12',
            'last_name' => 'required|max:100',
            'email' => 'required|email|max:200|unique:user,email,'.$this->admin_user_id,
            'password' => 'nullable|sometimes|confirmed',
        ];
    }

    public function attributes()
    {
        return [
            'company_name' => 'company name',
            'first_name' => 'first name',
            'last_name' => 'last name',
            'email' => 'email',
            'password' => 'password',
            'contact_no_1' => 'contact number',
            'contact_no_2' => 'contact number',
        ];
    }
}
