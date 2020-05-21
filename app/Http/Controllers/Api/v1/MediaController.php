<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImageRequest;
use App\Media;
use App\Services\SaveFile;

class MediaController extends Controller
{
    /**
     * @param ProductImageRequest $request
     * @param SaveFile $saveMediaFile
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductImageRequest $request, SaveFile $saveMediaFile)
    {
        $fileData = $saveMediaFile->handel($request->file('media_file'), 'shop/'.now()->format('F'));

        $file = new Media($fileData);
        $file->save();

        $fileData['id'] = $file->id;
        return response()->json($fileData);
    }

    public function show($media)
    {
        $fileData = Media::findOrFail($media);
        return response()->json($fileData);
    }

    public function destroy($mediaId)
    {
        $media = Media::findOrFail($mediaId);
        try {
            if($media->tryDelete())
                return response(['message' => 'Файл успішно видалений'], 200);
            else
                return response(['message' => 'Неможливо видалити зображення у якого є декілька прикріплених товарів'], 403);
        } catch (\Exception $exception){
            return response(['message' => $exception->getMessage()], 403);
        }
    }
}
