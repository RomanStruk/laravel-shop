<?php


namespace App\Tasks\Shipping;


use App\Repositories\ShippingRepository;
use Exception;
use Psy\Exception\ErrorException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GetCityByRefTask
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
     * @param $cityRef
     * @return array
     * @throws Exception
     */
    public function get($cityRef)
    {
        $result = $this->repository->findRef($cityRef);
//        dd($result);
        if (count($result->errors)>=1) throw new Exception($result->errors);;
        if ($result->info->totalCount <> 1) throw new Exception('totalCount <> 1');
        $data = [];
        foreach ($result->data[0] as $key => $value){
            $data[$key] = $value;
        }
        return $data;
    }
}
