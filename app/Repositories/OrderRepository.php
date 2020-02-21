<?php


namespace App\Repositories;
use App\Order as Model;

class OrderRepository
{
    public function getAll()
    {
        return Model::all();
    }
}
