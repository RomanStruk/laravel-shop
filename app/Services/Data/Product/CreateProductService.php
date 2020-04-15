<?php


namespace App\Services\Data\Product;


use App\Product;

class CreateProductService
{
    public function handel($input)
    {
        $product = new Product();
        $product->title = $input['title'];
        $product->alias = $input['alias'];
        $product->category_id = $input['category_id'];
        $product->keywords = $input['keywords'];
        $product->description = $input['description'];
        $product->content = $input['content'];
        $product->price = $input['price'];
        $product->in_stock = $input['in_stock'];
        $product->status = $input['status'];
        $product->save();
        $product->syncRelatedProducts($input['related']);
        return $product->id;
    }
}
