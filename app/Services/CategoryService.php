<?php


namespace App\Services;


use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use Exception;

class CategoryService
{
    /**
     * @var CategoryRepository
     */
    private $repo;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->repo = $categoryRepository;
    }

    public function categoriesOrderBy()
    {
        return Category::with('parent')
            ->orderBy('parent_id')
            ->get();
    }

    public function categories()
    {
        return Category::with('parent')
            ->where('parent_id', '=', 0)
            ->get();
    }
    public function save(CategoryRequest $request)
    {
        $category = new Category($request->only(['parent_id', 'name', 'slug', 'description']));
        $category->save();
        return $category->id;
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->only(['parent_id', 'name', 'slug', 'description']));
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        try {
            $category->delete();
        } catch (Exception $e) {
        }
    }
}
