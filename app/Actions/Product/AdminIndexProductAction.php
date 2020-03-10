<?php


namespace App\Actions\Product;


use App\Tasks\Product\GetAllProductsTask;
use Illuminate\Http\Request;

class AdminIndexProductAction
{
    /**
     * @var Request
     */
    private $request;

    /**
     * AdminIndexProductAction constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function run()
    {
//        $filters = $request->all()+['status' => '1'];
        $filters = $this->request->all();
        return (new GetAllProductsTask)->get($filters);
    }
}
