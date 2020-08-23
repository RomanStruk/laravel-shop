<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MediaRequest;
use App\Http\Requests\ProductImageRequest;
use App\Http\Resources\Admin\MediaResource;
use App\Media;
use App\Services\SaveFile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $medias = Media::orderByDesc('created_at')->paginate();
        return MediaResource::collection($medias)
            ->additional([
                'message' => 'Retrieve Data is Successfully',
                'success' => true
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductImageRequest $request
     * @param SaveFile $saveMediaFile
     * @return MediaResource
     */
    public function store(ProductImageRequest $request, SaveFile $saveMediaFile)
    {
        $fileData = $saveMediaFile->handel($request->file('media_file'), 'shop/' . now()->format('F'));

        $file = new Media($fileData);
        $file->save();

        return (new MediaResource($file))->additional([
            'message' => 'Файл успішно завантажений',
            'success' => true
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return MediaResource
     */
    public function show($id)
    {
        return (new MediaResource(Media::with('products')->find($id)))->additional([
            'message' => 'Retrieve Data is Successfully',
            'success' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MediaRequest $request
     * @param int $id
     * @return MediaResource
     */
    public function update(MediaRequest $request, $id)
    {
        $media = Media::findOrFail($id);
        $media->update($request->mediaFillData()->whereNotNull()->all());
        if ($request->willUpdateRelationProducts())
            $media->syncProducts($request->productsFillData()->all());
        return (new MediaResource($media))->additional([
            'message' => 'Retrieve Data is Successfully',
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        try {
            if($media->tryDelete()){
                return response()
                    ->json([
                        'message' => 'Файл успішно видалений',
                        'success' => true
                    ]);
            }else {
                return response()
                    ->json([
                        'message' => 'Неможливо видалити зображення у якого є декілька прикріплених товарів',
                        'success' => false
                    ]);
            }
        } catch (\Exception $exception){
            return response()
                ->json([
                    'message' => $exception->getMessage(),
                    'success' => false
                ]);
        }

    }
}
