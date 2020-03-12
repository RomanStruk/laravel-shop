<?php


namespace App\Services\Product;


use App\Product;
use Illuminate\Support\Collection;

class GetProductByIdOrSlug
{
    public function handel($idOrSlug)
    {
        $query = is_numeric($idOrSlug) ? ['id' => $idOrSlug] : ['slug' => $idOrSlug];

        return Product::with('category')
            ->with('comments')
            ->with('comments.user')
            ->with('comments.user.detail')
            ->with('product_attributes')
            ->with('product_attributes.group')
            ->where($query)
            ->get()->first();
    }
}
