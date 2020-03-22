<?php


namespace App\Tasks\Category;


use App\Repositories\CategoryRepository;

class GetCategoryBySlugOrIdTask
{
    /**
     * @var CategoryRepository
     */
    private $repository;
    public function __construct()
    {
        $this->repository = CategoryRepository::getInstance();
    }

    public function get($slugOrId)
    {
        $query = is_numeric($slugOrId) ? ['id' => $slugOrId] : ['slug' => $slugOrId];
        return $this->repository->findWhere($query)->first();
    }

}
