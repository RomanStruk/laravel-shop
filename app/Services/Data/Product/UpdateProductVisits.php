<?php


namespace App\Services\Data\Product;


use App\Product;

class UpdateProductVisits
{
    public function handel($productId)
    {
        $model = Product::findOrFail($productId);
        $model->visits = $model->visits + 1;

        // disable the timestamps before saving
        $model->timestamps = false;
        $model->save();
        return $model;
    }
}
