<?php


namespace App\Services\Product;


use App\Product;

class DeleteProductById
{
    public function handel($id, $forceDelete = false)
    {
        try {
            if ($forceDelete){
                return Product::firstOrFail($id)->forceDelete();
            }
            return Product::firstOrFail($id)->delete();
        } catch (\Exception $e) {
        }
    }

}
