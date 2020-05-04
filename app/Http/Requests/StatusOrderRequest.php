<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusOrderRequest extends FormRequest
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
            'notification' => 'required|boolean',
//            'status' => 'required|numeric|between:1,5',
            'status' => ['required', 'numeric'],
            'comment' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['notification' => $this->has('status') ? true : false]);
    }

    /**
     * Return the fields and values to update Order.
     *
     * @return array
     */
    public function statusFillData()
    {
        return [
            'status'    => $this->status,
            'comment'    => $this->comment,
        ];
    }
}
