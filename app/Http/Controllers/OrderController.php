<?php

namespace App\Http\Controllers;

use App\Events\OrderCreatedEvent;
use App\Order;
use Illuminate\Http\Request;
use Validator;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $order = Order::with('user')->findOrFail(1);
//        dd($order);
        event(new OrderCreatedEvent($order));   // event

        return view('vue.checkout');
    }


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
/*        $test = new Order();
        $test->user_id = 1;
        $test->pay_method = '1';
        $test->comment = 'dfsdfsdfsdf';
        $test->created_at = Carbon::now();
        $test->updated_at = Carbon::now();

        $test->save();*/
    }
}
