<?php


namespace App\Tasks\Category;


use App\Repositories\CategoryRepository;

class DeleteCategoryTask
{
    /**
     * @var CategoryRepository
     */
    private $repository;
    public function __construct()
    {
        $this->repository = CategoryRepository::getInstance();
    }

    public function delete($id)
    {
        $category = $this->repository->findWhere(['id' => $id])->first();
        return $category->delete();
    }
}
