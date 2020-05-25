<?php


namespace App\Models\Scope;


use App\Order;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ProductTop implements Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
        return $builder
            ->select(['id', 'alias', 'title', 'category_id', 'price', 'old_price'])
            ->withCount(['orderProduct as c' => function($query) {
                $query->whereHas('order', function ($query) {
                    $query->where('status', '=', Order::STATUS_COMPLETED);
                })->select(DB::raw("SUM(count)"));
            }])
            ->orderByDesc('c');
    }
}
