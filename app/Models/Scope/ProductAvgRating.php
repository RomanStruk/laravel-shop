<?php


namespace App\Models\Scope;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ProductAvgRating implements Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
        return $builder->withCount(['comments as average_rating' => function($query) {
            $query->select(\DB::raw('coalesce(avg(rating),0)'));
        }]);
    }
}
