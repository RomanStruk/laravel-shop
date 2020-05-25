<?php

namespace App\Models;

use App\Models\Scope\ProductAvgRating;
use App\Order;
use App\Traits\Relations\ProductRelations;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use ProductRelations;


    public $fillable = ['alias', 'title', 'category_id', 'keywords', 'description', 'content', 'price', 'in_stock', 'status'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ProductAvgRating());
    }

    public function scopeTop(Builder $query, int $limit)
    {
        return $query
            ->select(['id', 'alias', 'title', 'category_id', 'price', 'old_price'])
            ->withCount(['orderProduct as c' => function($query) {
                $query->whereHas('order', function ($query) {
                    $query->where('status', '=', Order::STATUS_COMPLETED);
                })->select(DB::raw("SUM(count)"));
            }])
            ->orderByDesc('c')
            ->limit($limit);
    }

}
