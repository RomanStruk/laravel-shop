<?php


namespace App\Services\Media;


use App\Media;
use App\Product;

class UpdateRelationships
{
    public function handel($productId, $mediaId, $method)
    {
        switch ($method) {
            case 'attach':
                if (is_integer($mediaId)){
                    $media = Media::select(['id'])->findOrFail($mediaId);
                    $media->products()->attach($productId);
                }
                if (is_integer($productId)){
                    $product = Product::select(['id'])->findOrFail($productId);
                    $product->media()->attach($mediaId);
                }
                break;
            case 'detach':
                if (is_integer($mediaId)){
                    $media = Media::select(['id'])->findOrFail($mediaId);
                    $media->products()->detach($productId);
                }
                if (is_integer($productId)){
                    $product = Product::select(['id'])->findOrFail($productId);
                    $product->media()->detach($mediaId);
                }
                break;
            case 'sync':

                break;
        }
    }

}
