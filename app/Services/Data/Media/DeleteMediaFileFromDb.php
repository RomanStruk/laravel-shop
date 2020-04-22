<?php


namespace App\Services\Data\Media;


use App\Media;

class DeleteMediaFileFromDb
{
    public function handel($id)
    {
        $media = Media::findOrFail($id);
        if ($media->products()->count() > 1) return false;
        $path = $media->path;
        $disc = $media->disc;
        $media->delete(); //observer видаляє зображення з диска
        return [
            'path' => $path,
            'disc' => $disc
        ];
    }
}
