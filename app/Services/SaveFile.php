<?php


namespace App\Services;


use Illuminate\Http\UploadedFile;
use Storage;

class SaveFile
{
    /**
     * @param UploadedFile $file
     * @param $folder
     * @param string $name
     * @param string $disc public|local|s3
     * @param string $visibility private|public
     * @return array
     */
    public function handel(UploadedFile $file, $folder, $name = '',  $disc = 'public', $visibility = 'public')
    {
        $extension = $file->extension();
        if (!empty($name)) {
            $path = Storage::disk($disc)->putFileAs($folder, $file, $name, $visibility);
        } else {
            $path = Storage::disk($disc)->putFile($folder, $file, $visibility);
        }
        $url = Storage::url($path);
        $size = Storage::disk($disc)->size($path);
        $getVisibility = Storage::disk($disc)->getVisibility($path);

        return [
            'path' => $path,
            'extension' => $extension,
            'size' => $size,
            'url' => $url,
            'visibility' => $getVisibility,
            'disc' => $disc,
            'name' => $name
        ];
    }

}
