<?php


namespace App\Services\Media;


use App\Media;

class GetMediasByLimit
{
    public function handel()
    {
        $medias = Media::orderByDesc('created_at')->paginate();
        return $medias;
    }
}
