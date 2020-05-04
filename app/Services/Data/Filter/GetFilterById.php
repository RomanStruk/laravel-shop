<?php


namespace App\Services\Data\Filter;


use App\Filter;

class GetFilterById
{
    public function handel($id)
    {
        return Filter::findOrFail($id);
    }
}
