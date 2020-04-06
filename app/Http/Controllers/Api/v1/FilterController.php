<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\Data\Filter\GetFilters;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index(Request $request, GetFilters $getFilters)
    {
        $filters = $getFilters->handel(false, ['*'], $request->get('category'));
        return response()->json($filters);
    }
}
