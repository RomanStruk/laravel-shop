<?php


namespace App\Tasks\Order;


use App\Repositories\OrderRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteTask
{
    /**
     * @var OrderRepository
     */
    private $repository;

    /**
     * OrderTasks constructor.
     */
    public function __construct()
    {
        $this->repository = OrderRepository::getInstance();
    }

    public function delete($id)
    {
        $order = $this->repository->find($id);
        try {
            $this->repository->delete($order);
        } catch (Exception $e) {
            throw new ModelNotFoundException();
        }
    }
}
