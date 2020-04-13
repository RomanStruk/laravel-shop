<?php


namespace App\Traits\Helpers;


use Illuminate\Database\Eloquent\Builder;

trait ProductHelper
{
    public function scopeAvgRating(Builder $builder)
    {
        return $builder->withCount(['comments as average_rating' => function($query) {
            $query->select(\DB::raw('coalesce(avg(rating),0)'));
        }]);
    }

    public function scopeCountComments(Builder $builder)
    {
        return $builder->withCount('comments');
    }
}
