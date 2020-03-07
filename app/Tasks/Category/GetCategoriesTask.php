<?php


namespace App\Tasks\Category;


use App\Repositories\CategoryRepository;

class GetCategoriesTask
{
    /**
     * @var CategoryRepository
     */
    private $repository;
    public function __construct()
    {
        $this->repository = CategoryRepository::getInstance();
    }

    public function get()
    {
        return $this->repository->all();
    }
}
