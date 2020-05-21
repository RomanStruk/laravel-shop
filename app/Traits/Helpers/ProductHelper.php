<?php


namespace App\Traits\Helpers;


use App\Syllable;
use Illuminate\Database\Eloquent\Builder;
use phpDocumentor\Reflection\Types\Integer;

trait ProductHelper
{

    /**
     * кількість всього доступних товарів з урахуванням не розглянутих замовлень
     *
     * @return int
     */
    public function availableRemains() : int
    {
        return $this->syllable->sum('countAvailableRemains');
    }


    /**
     * скільки всього є товарів на складах без врахування нерозглянутих замовлень
     *
     * @return mixed
     */
    public function quality()
    {
        return $this->syllable->sum('remains');
    }



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

    /**
     * @param $syllable
     * @return mixed|null
     */
    public function createSyllable($syllable)
    {
        if ($syllable){
            return $this->syllable()->create($syllable);
        }
        return null;
    }

    public function syncRelatedProducts($products)
    {
        return $this->related()->sync($products);
    }

    public function syncAttributesOfFilters(array $attributes)
    {
        return $this->product_attributes()->sync($attributes);
    }

    public function syncMediaFiles(array $media)
    {
        $this->media()->detach();
        return $this->media()->attach($media);
    }
}
