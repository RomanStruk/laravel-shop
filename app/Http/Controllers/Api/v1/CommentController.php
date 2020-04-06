<?php

namespace App\Http\Controllers\Api\v1;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Services\Data\Comment\GetCommentsByProduct;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(GetCommentsByProduct $getComments, $productId)
    {
        $result = $getComments->handel($productId);
        return response()->json($result);
    }
}
