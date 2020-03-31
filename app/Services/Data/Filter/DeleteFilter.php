<?php


namespace App\Services\Data\Filter;


use App\Filter;

class DeleteFilter
{
    public function handel($id)
    {
        $filterModel = Filter::findOrFail($id);
        return $filterModel->delete();
    }
}
