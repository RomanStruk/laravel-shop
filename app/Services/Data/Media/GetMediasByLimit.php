<?php


namespace App\Services\Data\Media;


use App\Media;

class GetMediasByLimit
{
    public function handel()
    {
        $medias = Media::orderByDesc('created_at')->paginate();
        return $medias;
    }
}
