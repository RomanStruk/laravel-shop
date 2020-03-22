<?php


namespace App\Services\Media;


use Storage;

class DeleteMediaFile
{
    public function handel($path, $disc)
    {
        if (! Storage::disk($disc)->exists($path)) return false;
        return Storage::disk($disc)->delete($path);
    }
}
