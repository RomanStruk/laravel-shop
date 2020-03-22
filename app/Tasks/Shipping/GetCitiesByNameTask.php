<?php


namespace App\Tasks\Shipping;


use App\Repositories\ShippingRepository;
use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GetCitiesByNameTask
{
    /**
     * @var ShippingRepository
     */
    private $repository;

    /**
     * OrderTasks constructor.
     */
    public function __construct()
    {
        $this->repository = ShippingRepository::getInstance();
    }

    /**
     * @param $cityName
     * @return mixed
     * @throws Exception
     */
    public function get($cityName)
    {
        $cities = $this->repository->findCity($cityName);

        if (count($cities->errors)>=1) throw new Exception($cities->errors);;
        if ($cities->info->totalCount == 0) throw new Exception('Error totalCount = 0');

        return $cities->data;
    }
}
