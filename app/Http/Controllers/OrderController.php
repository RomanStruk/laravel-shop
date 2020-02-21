<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class OrderController extends Controller
{
    public function checkOut(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|numeric|min:12',
            'city_code' => 'required|integer',
            'email' => 'required|email:rfc|unique:users|max:255',
            'type_delivery' => 'required',
            'pay_method' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/checkout')
                ->withErrors($validator)
                ->withInput();
        }

        return $request->all();
    }
}
