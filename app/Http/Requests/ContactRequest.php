<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' =>'required|max:25',
            'email' => 'required|email',
            'website' => '',
            'subject' => 'required',
            'message' => 'required'
        ];
    }

    public function messages()
    {
        return [
           'email.required' => 'Поле :attribute обовязкове до заповнення.'
        ];
    }

}
