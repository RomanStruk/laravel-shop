<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreCommentPost;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function apiGetComments(Request $request)
    {
//        dd($request);
        $comments = Comment::with('user')->where('product_id', '=', $request->get('product_id'))->get();
        return $comments;
    }

    public function create(StoreCommentPost $request)
    {

        $validated = $request->validated();
        $comment = new Comment();
        $comment->product_id = $validated['id_product'];
        $comment->user_id = auth()->id();
        $comment->text = $validated['text'];
        $comment->rating = $validated['rating'];
        $comment->save();
//        dd($validated);
//        $request->session()->pull('key', 'default');
        return redirect()->back()->with('success', 'Ваш коментар успішно додано');
    }
}
