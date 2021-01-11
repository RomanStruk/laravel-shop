<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\Admin\CategoryResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $categories = Category::allRelations(false)
            ->select(['id', 'slug', 'name', 'parent_id', 'description'])
            ->paginate($request->limit);

        return CategoryResource::collection($categories)
            ->additional([
                'message' => 'Retrieve Data is Successfully',
                'success' => true
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return CategoryResource|JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category($request->validated());
        if ($category->save()) {
            return (new CategoryResource($category))
                ->additional([
                    'message' => 'Категорія успішно створена',
                    'success' => true
                ])
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);
        } else {
            return response()->json(['message' => 'Creating error', 'success' => false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return CategoryResource
     */
    public function show($id)
    {
        $category = Category::with(['parent'])->findOrFail($id);
        return (new CategoryResource($category))->additional([
            'message' => 'Retrieve Data is Successfully',
            'success' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param int $id
     * @return CategoryResource|JsonResponse
     */
    public function update(CategoryRequest $request, $id)
    {
        $updateCategory = Category::findOrFail($id);
        if ($updateCategory->update($request->validated())) {
            $updateCategory->load('parent');
            return (new CategoryResource($updateCategory))
                ->additional([
                    'message' => 'Категорія успішно оновлена',
                    'success' => true
                ])
                ->response()
                ->setStatusCode(Response::HTTP_ACCEPTED);
        } else {
            return response()->json(['message' => 'Updating error', 'success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        if (Category::destroy($id)) {
            return response()->json([
                'message' => 'Категорія успішно видалена',
                'success' => true
            ]);
        } else {
            return response()->json(['message' => 'Deleting error', 'success' => false]);
        }
    }
}
