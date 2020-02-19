<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function apiGetComments(Request $request)
    {
//        dd($request);
        $comments = Comment::with('user')->where('product_id', '=', $request->get('product_id'))->get();
        return $comments;
    }
}
