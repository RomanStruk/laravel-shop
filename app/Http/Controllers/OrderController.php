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
            'city' => 'required',
            'email' => 'required|email:rfc|unique:users|max:255',
            'type_delivery' => 'required',
            'pay_method' => 'required',
            'products' => 'required|array',
        ]);

        if ($validator->fails()) {
            return redirect('/checkout')
                ->withErrors($validator)
                ->withInput();
        }

        return $request->all();
    }
}
