<?php


namespace App\Services\Data\Product;


use App\Product;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Integer;

class GetProductByIdOrSlug
{
    /**
     * Get product from database
     * @param integer|string $idOrSlug
     * @param array $fields
     * @param bool $trashed
     * @return mixed
     */
    public function handel($idOrSlug, $fields = ['*'], $trashed = false)
    {
        $query = is_numeric($idOrSlug) ? ['id' => $idOrSlug] : ['slug' => $idOrSlug];

        $product = Product::select($fields);

        if ($trashed) $product->withTrashed();

        return $product
            ->with('category')
            ->with('comments')
            ->with('comments.user')
            ->with('comments.user.detail')
            ->with('product_attributes')
            ->with('product_attributes.filter')
            ->where($query)
            ->get()
            ->first();
    }
}
