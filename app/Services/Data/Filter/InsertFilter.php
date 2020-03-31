<?php


namespace App\Services\Data\Filter;


use App\Attribute;
use App\Filter;

class InsertFilter
{
    public function handel($insert)
    {
        $filter = new Filter();
        $filter->name = $insert['name'];
        $filter->save();
        $attributes = [];
        foreach ($insert['value'] as $item){
            if (! empty($item))
                $attributes[] = new Attribute(['value' => $item]);
        }
        $filter->allAttributes()->saveMany($attributes);
        return $filter;
    }
}
