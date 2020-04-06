<?php


namespace App\Services\Data\Product;


use App\Product;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Integer;

class GetProductByIdOrSlug
{
    /**
     * Get product from database
     * @param integer|string $idOrAlias
     * @param array $fields
     * @param bool $trashed
     * @return mixed
     */
    public function handel($idOrAlias, $fields = ['*'], $trashed = false)
    {
        $query = is_numeric($idOrAlias) ? ['id' => $idOrAlias] : ['alias' => $idOrAlias];

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
            ->firstOrFail();
    }
}
