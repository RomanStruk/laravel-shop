<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MediaRequest;
use App\Product;
use App\Services\Data\Media\DeleteMediaFileFromDb;
use App\Services\Data\Media\GetMediaById;
use App\Services\Data\Media\GetMediasByLimit;
use App\Services\SaveFile;
use App\Services\Data\Media\SaveToDbMediaFile;
use App\Services\Data\Media\UpdateMediaFile;
use App\Services\Data\Media\UpdateRelationships;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param GetMediasByLimit $getMediasByLimit
     * @return Factory|View
     */
    public function index(GetMediasByLimit $getMediasByLimit)
    {
        $medias = $getMediasByLimit->handel();
        return view('admin.media.index')
            ->with('medias', $medias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $products = Product::select(['id', 'title'])->get();
        return view('admin.media.create')
            ->with('products', $products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MediaRequest $request
     * @param SaveFile $saveMediaFile
     * @param SaveToDbMediaFile $dbMediaFile
     * @return RedirectResponse
     */
    public function store(MediaRequest $request,
                          SaveFile $saveMediaFile,
                          SaveToDbMediaFile $dbMediaFile)
    {
        $files=[];
        $productId = $request['products']?$request['products']:'none';
        foreach($request->file('media') as $file){
            $folder = $request['disc'] == 'public' ? 'shop/'.$productId : 'local';
            $fileData = $saveMediaFile->handel(
                $file,
                $folder,
                '',
                $request['disc'],
                $request['visibility']
            );
            $files[] = $dbMediaFile->handel(
                $fileData,
                $request['name'], $request['keywords'], $request['description']
            );
        }
        if ($request['products']){
            (new UpdateRelationships())->handel((int)$productId, $files, 'attach');
        }
        return redirect()->route('admin.media.index')
            ->with('success', __('media.save'));
    }

    /**
     * Display the specified resource.
     *
     * @param $mediaId
     * @param GetMediaById $getMediaById
     * @return Factory|View
     */
    public function show($mediaId, GetMediaById $getMediaById)
    {
        $media = $getMediaById->handel($mediaId);
//        dd($media);
        return view('admin.media.show')
            ->with('media', $media);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param GetMediaById $getMediaById
     * @param $mediaId
     * @return Factory|View
     */
    public function edit(GetMediaById $getMediaById, $mediaId)
    {
        $media = $getMediaById->handel($mediaId);
        return view('admin.media.edit')
            ->with('media', $media)
            ->with('products', Product::select(['id', 'title'])->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MediaRequest $request
     * @param UpdateMediaFile $updateMediaFile
     * @param $mediaId
     * @return RedirectResponse
     */
    public function update(MediaRequest $request,
                           UpdateMediaFile $updateMediaFile,
                           $mediaId)
    {
        $fields = $request->only(['name', 'keywords', 'description', 'disc', 'visibility']);
        $updateMediaFile->handel($mediaId, $fields, $request->input('products'));
//        dd($request->all());
        return redirect()->back()->with('success', __('media.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteMediaFileFromDb $deleteMediaFileFromDb
     * @param $mediaId
     * @return RedirectResponse
     */
    public function destroy(DeleteMediaFileFromDb $deleteMediaFileFromDb, $mediaId)
    {
        if($deleteMediaFileFromDb->handel($mediaId))
            return  redirect()->route('admin.media.index')->with('success', __('media.delete'));
        else
            return redirect()->back()->withErrors([__('media.cant_delete')]);
    }
}
