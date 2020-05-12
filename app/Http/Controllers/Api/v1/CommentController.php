<?php

namespace App\Http\Controllers\Api\v1;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index($productId)
    {
        $result = Comment::with('user')->where('product_id', '=', $productId)->get();
        return response()->json($result);
    }
}
