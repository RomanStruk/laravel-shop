<?php


namespace App\Services\Media;


use App\Media;

class DeleteMediaFileFromDb
{
    public function handel($id)
    {
        $media = Media::findOrFail($id);
        $path = $media->path;
        $disc = $media->disc;
        $media->delete();
        return [
            'path' => $path,
            'disc' => $disc
        ];
    }
}
