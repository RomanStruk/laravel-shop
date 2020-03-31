<?php


namespace App\Services\Data\Media;


use App\Media;

class SaveToDbMediaFile
{
    public function handel($file, $name, $keywords, $description)
    {
        $insert = [
            'path' => $file['path'],
            'extension' => $file['extension'],
            'size' => $file['size'],
            'url' => $file['url'],
            'visibility' => $file['visibility'],
            'disc' => $file['disc'],
            'name' => $name,
            'keywords' => $keywords,
            'description' => $description,
        ];
        return Media::create($insert)->id;
    }

}
