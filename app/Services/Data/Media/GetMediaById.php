<?php


namespace App\Services\Data\Media;


use App\Media;

class GetMediaById
{
    public function handel($id)
    {
        $media = Media::with('products:products.id,products.title')->findOrFail($id);
        return $media;
    }
}
