<?php


namespace App\Traits\Helpers;


use App\Syllable;
use Illuminate\Database\Eloquent\Builder;
use phpDocumentor\Reflection\Types\Integer;

trait ProductHelper
{
    // кількість доступних товарів по по конкретній поставці
    public function availableSyllableRemains($syllableId)
    {
        $syllable = $this->syllable()->findOrFail($syllableId);
        return $syllable->remains - $syllable->countProcessed();
    }


    // кількість всього доступних товарів з урахуванням не розглянутих замовлень
    public function availableRemains() : int
    {
        $available = 0;
        $bol = true;
        foreach ($this->syllable as $syllable){
            $s = $syllable->remains - $syllable->countProcessed();
            if ($s <= 0){
                $bol = false;
                continue;
            }
            $available += $s;
        }
        if ($bol)
            return $available;
        return 0;
    }


    // повертає першу достуну складську поставку
    public function availableSyllable()
    {
        foreach ($this->syllable as $syllable){
            if ($syllable->remains - $syllable->countProcessed() > 0)
                return $syllable;
        }
        return null;
    }

    // скільки всього є товарів на складах без врахування нерозглянутих замовлень
    public function quality()
    {
        return $this->syllable->sum('remains');
    }

    public function createSyllable($syllable)
    {
        if ($syllable){
            return $this->syllable()->create($syllable);
        }
        return null;
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
