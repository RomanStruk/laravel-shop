<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\MediaRequest;
use App\Http\Requests\ProductImageRequest;
use App\Media;
use App\Services\Data\Media\DeleteMediaFileFromDb;
use App\Services\Data\Media\SaveToDbMediaFile;
use App\Services\SaveFile;

class MediaController extends Controller
{
    /**
     * @param ProductImageRequest $request
     * @param SaveFile $saveMediaFile
     * @param SaveToDbMediaFile $dbMediaFileService
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductImageRequest $request, SaveFile $saveMediaFile, SaveToDbMediaFile $dbMediaFileService)
    {
        $fileData = $saveMediaFile->handel($request->file('media_file'), 'shop/'.now()->format('F'));
        $file = $dbMediaFileService->handel(
            $fileData,
            $fileData['name'],
            '',
            ''
        );
        $fileData['id'] = $file;
        return response()->json($fileData);
    }

    public function show($media)
    {
        $fileData = Media::findOrFail($media);
//        dd($fileData);
        return response()->json($fileData);
    }

    public function destroy(DeleteMediaFileFromDb $deleteMediaFileFromDb, $mediaId)
    {
        try {
            if($deleteMediaFileFromDb->handel($mediaId))
                return response(['message' => 'Файл успішно видалений'], 200);
            else
                return response(['message' => 'Неможливо видалити зображення у якого є декілька прикріплених товарів'], 403);
        } catch (\Exception $exception){
            return response(['message' => $exception->getMessage()], 403);
        }
    }
}