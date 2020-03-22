<?php


namespace App\Services\Attribute;


use App\GroupAttribute;

class GetAttributes
{
    public function handel()
    {
        return GroupAttribute::with('allAttributes')
            ->get();
    }
}
