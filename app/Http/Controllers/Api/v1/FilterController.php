<?php

namespace App\Http\Controllers\Api\v1;

use App\FilterGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index(Request $request)
    {
        $filters = FilterGroup::allRelations()->get();
        return response()->json($filters);
    }
}
