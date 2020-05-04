<?php


namespace App\Services\Data\Filter;


use App\Attribute;
use App\Filter;

class UpdateFilter
{
    public function handel($id, $update)
    {
        $filterModel = Filter::with('filterValues')->findOrFail($id);
        $filterModel->update(
            ['name' => $update['name']]
        );
        $filterModel->filterValues()->delete();

        $result = [];
        foreach ($update['value'] as $item){
            if (! empty($item))
                $result[] = new Attribute(['value' => $item]);
        }
        return $filterModel->filterValues()->saveMany($result);
    }
}
