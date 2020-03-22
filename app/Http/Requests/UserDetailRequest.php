<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class UserDetailRequest extends FormRequest
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
            'first_name' => ['required'],
            'last_name' => ['required'],
            'phone' => ['required', new PhoneNumber],
            'country' => ['nullable', 'string', 'min:3', 'max:255'],
            'birthday' => ['nullable', 'date_format:Y-m-d'],
            'location' => ['nullable', 'string', 'min:3', 'max:255'],
            'avatar' => [
                'nullable',
                'mimes:png,jpeg,jpg,gif',
                'max:2048',
                'dimensions:min_width=100,min_height=100,max_width=400,max_height=400']
        ];
    }
}
