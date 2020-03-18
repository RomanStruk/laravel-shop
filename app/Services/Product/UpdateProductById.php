<?php


namespace App\Services\Product;


use App\Product;

class UpdateProductById
{
    public function handel($id, $updateFields, $attributes = null, $media = null, $comments = null)
    {
        $product = Product::findOrFail($id);
        if($updateFields){
            $product->title = $updateFields['title'];
            $product->alias = $updateFields['alias'];
            $product->category_id = $updateFields['category_id'];
            $product->keywords = $updateFields['keywords'];
            $product->content = $updateFields['content'];
            $product->description = $updateFields['description'];
            if ($updateFields['price'] < $product->price){
                $product->old_price = $product->price;
            }
            $product->price = $updateFields['price'];
            $product->status = $updateFields['status'];
            $product->in_stock = $updateFields['in_stock'];
            $product->save();
        }

        if ($attributes)
            $product->product_attributes()->sync($attributes);
        if ($media)
            $product->media()->sync($media);
//            $product->media()->associate($media);

    }

}
