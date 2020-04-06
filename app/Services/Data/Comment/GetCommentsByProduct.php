<?php


namespace App\Services\Data\Comment;


use App\Comment;

class GetCommentsByProduct
{
    public function handel($productId)
    {
        return Comment::with('user')
            ->where('product_id', '=', $productId)
            ->get();
    }
}
