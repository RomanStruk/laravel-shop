<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MediaRequest;
use App\Media;
use App\Product;
use App\Services\PaginateSession;
use App\Services\SaveFile;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PaginateSession $paginateSession
     * @return Factory|View
     */
    public function index(PaginateSession $paginateSession)
    {
        $medias = Media::orderByDesc('created_at')->paginate($paginateSession->getLimit());
        return view('admin.media.index')->with('medias', $medias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $products = Product::select(['id', 'title'])->get();
        return view('admin.media.create')->with('products', $products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MediaRequest $request
     * @param SaveFile $saveMediaFile
     * @return RedirectResponse
     */
    public function store(MediaRequest $request, SaveFile $saveMediaFile)
    {
        foreach($request->file('media') as $file){
            $folder = $request['disc'] == 'public' ? ('shop/'.$request->input('products')[0] ?? 'none') : 'local';
            $fileData = $saveMediaFile->handel($file, $folder, '', $request['disc'], $request['visibility']);
            $media = new Media(array_merge($fileData, $request->mediaFillData()->all()));
            $media->save();
            if($request->willUpdateRelationProducts())
                $media->syncProducts($request->productsFillData()->all());
        }
        return redirect()->route('admin.media.index')
            ->with('success', __('media.save'));
    }

    /**
     * Display the specified resource.
     *
     * @param $mediaId
     * @return Factory|View
     */
    public function show($mediaId)
    {
        $media = Media::with('products:products.id,products.title')->findOrFail($mediaId);
//        dd($media);
        return view('admin.media.show')
            ->with('media', $media);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $mediaId
     * @return Factory|View
     */
    public function edit($mediaId)
    {
        $media = Media::with('products:products.id,products.title')->findOrFail($mediaId);
        return view('admin.media.edit')
            ->with('media', $media)
            ->with('products', Product::select(['id', 'title'])->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MediaRequest $request
     * @param $mediaId
     * @return RedirectResponse
     */
    public function update(MediaRequest $request, $mediaId)
    {

        $media = Media::findOrFail($mediaId);
        $media->update($request->mediaFillData()->whereNotNull()->all());
        $media->syncProducts($request->productsFillData()->all());

        return redirect()->back()->with('success', __('media.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $mediaId
     * @return RedirectResponse
     */
    public function destroy($mediaId)
    {
        $media = Media::findOrFail($mediaId);
        try {
            if ($media->tryDelete()){
                return  redirect()->route('admin.media.index')->with('success', __('media.deleted'));
            }else{
                return redirect()->back()->withErrors([__('media.cant_delete')]);
            }
        } catch (Exception $exception ){
            return redirect()->back()->withErrors($exception->getMessage());
        }

    }
}
