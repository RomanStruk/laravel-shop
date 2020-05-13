<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Syllable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SyllableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $syllables = Syllable::orderBy('supplier_id')->latest()->paginate();
        return view('admin.syllable.index')->with('syllables', $syllables);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
