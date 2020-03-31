<?php


namespace App\Services\Data\Media;


use App\Media;

class UpdateMediaFile
{
    /**
     * @param $id
     * @param $fields
     * @param null $products
     * @return bool
     */
    public function handel($id, $fields, $products = null)
    {
        $media = Media::findOrFail($id);
        $media->name = $fields['name'];
        $media->keywords = $fields['keywords'];
        $media->description = $fields['description'];
        $media->disc = $fields['disc'];
        $media->visibility = $fields['visibility'];
        if ($products){
            $media->products()->sync($products);
        }
        return $media->save();
    }
}
