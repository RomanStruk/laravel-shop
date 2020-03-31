<?php


namespace App\Services\Data\Product;


use App\Product;

class DeleteProductById
{
    public function handel($id, $forceDelete = false)
    {
        $product = Product::withTrashed()->findOrFail($id);
        try {
            if ($forceDelete){
                return $product->forceDelete();
            }
            return $product->delete();
        } catch (\Exception $e) {
            throw abort(304);
        }
    }

}
