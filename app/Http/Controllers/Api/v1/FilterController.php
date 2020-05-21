<?php

namespace App\Http\Controllers\Api\v1;

use App\Filter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index(Request $request)
    {
        $filters = Filter::allRelations()->get();
        return response()->json($filters);
    }
}
