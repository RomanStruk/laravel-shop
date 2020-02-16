<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function processingData(ContactRequest $request){
        dd($request);
        if ($request->isMethod('post')){
            /*Request $request
             * $rules = [
                'name' =>'required|max:25',
                'email' => 'required|email',
                'website' => '',
                'subject' => 'required',
                'message' => 'required'
                ];
            $this->validate($request, $rules);
        dd($request->all());
*/

        }
        $this->show();
    }
    public function show(){

        return view('contact');
    }
}
