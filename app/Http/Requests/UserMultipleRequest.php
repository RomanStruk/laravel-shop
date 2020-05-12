<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserMultipleRequest extends FormRequest
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
        $formRequests = [
            UserRequest::class,
            UserDetailRequest::class
        ];

        $rules = [];

        foreach ($formRequests as $source) {
            $rules = array_merge(
                $rules,
                (new $source)->rules()
            );
        }

        return $rules;
    }
    protected function prepareForValidation()
    {
        $this->merge(['name' => $this->get('email')]);
    }

    /**
     * Return the fields and values to update Order.
     *
     * @return array
     */
    public function userFillData()
    {
        return [
            'email'    => $this->email,
            'password'    => $this->password,
        ];
    }
    /**
     * Return the fields and values to update Order.
     *
     * @return array
     */
    public function userDetailFillData()
    {
        return [
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'phone'         => $this->phone,
            'country'       => $this->country,
            'birthday'      => $this->birthday,
            'location'      => $this->location,
        ];
    }
}
