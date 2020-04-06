<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreCommentPost;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function create(StoreCommentPost $request, $product)
    {

        $validated = $request->validated();
        $comment = new Comment();
        $comment->product_id = $product;
        $comment->user_id = auth()->id();
        $comment->text = $validated['text'];
        $comment->rating = $validated['rating'];
        $comment->save();
//        dd($validated);
//        $request->session()->pull('key', 'default');
        return redirect()->back()->with('success', 'Ваш коментар успішно додано');
    }
}
