<?php


namespace App\Services\Product;


use App\Product;

class UpdateProductById
{
    public function handel($id, $updateFields, $attributes = null, $comments = null)
    {
        $product = Product::findOrFail($id);
        $product->title = $updateFields['title'];
        $product->alias = $updateFields['alias'];
        $product->category_id = $updateFields['category_id'];
        $product->keywords = $updateFields['keywords'];
        $product->description = $updateFields['description'];
        $product->content = $updateFields['content'];
        if ($updateFields['price'] < $product->price){
            $product->old_price = $product->price;
        }
        $product->price = (int)((float)$updateFields['price']*100);
        $product->status = $updateFields['status'];
        $product->in_stock = $updateFields['in_stock'];
        $product->save();
        if ($attributes)
            $product->product_attributes()->sync($attributes);

    }

}
