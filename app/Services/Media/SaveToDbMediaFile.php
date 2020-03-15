<?php


namespace App\Services\Media;


use App\Media;

class SaveToDbMediaFile
{
    public function handel($file, $title, $keywords, $description)
    {
        $insert = [
            'path' => $file['path'],
            'extension' => $file['extension'],
            'size' => $file['size'],
            'url' => $file['url'],
            'visibility' => $file['visibility'],
            'disc' => $file['disc'],
            'name' => $title,
            'keywords' => $keywords,
            'description' => $description,
        ];
        return Media::create($insert)->id;
    }

}
