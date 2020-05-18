<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Syllable
 *
 * @property int $id
 * @property int $product_id
 * @property int $supplier_id
 * @property int $imported
 * @property int $remains
 * @property int $processed
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Product $product
 * @property-read \App\Supplier $supplier
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Syllable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Syllable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Syllable query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Syllable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Syllable whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Syllable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Syllable whereImported($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Syllable whereProcessed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Syllable whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Syllable whereRemains($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Syllable whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Syllable whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Syllable extends Model
{
    //склад
    protected $fillable = ['imported', 'remains', 'price', 'product_id', 'supplier_id', 'description'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class)->withDefault(['id'=>0,'name'=>'Deleted']);
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault(['id'=>0,'title'=>'Deleted']);
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products');
    }




    /**
     * Видібка з підрахунком кількості товарів на розгляді
     * countProcessed
     * select `syllables`.*, COALESCE((select SUM(count) from `order_products` where `syllables`.`id` = `order_products`.`syllable_id` and exists (select * from `orders` where `order_products`.`order_id` = `orders`.`id` and (`status` = 2 or `status` = 1) and `orders`.`deleted_at` is null)),0) as `count_processed` from `syllables` where `syllables`.`product_id` = 7 and `syllables`.`product_id` is not null HAVING count_processed<`remains`
     *
     * @param Builder $builder
     * @param null $exclude
     * @return Builder
     */
    public function scopeCountProcessed(Builder $builder, $exclude = null)
    {
        return $builder->withCount(['orderProduct as countProcessed' => function($query) use($exclude) {
                $query->select(\DB::raw('COALESCE(SUM(count),0)'))->whereHas('order', function ($query) use($exclude){
                    $query->where('status', '=', Order::STATUS_PROCESSING)->orWhere('status', '=', Order::STATUS_PENDING);
                    if ($exclude) $query->where('id', '<>', $exclude);
                });
            }]);
    }

    /**
     * Видібка з підрахунком кількості доступних товарів
     * countAvailableRemains
     *
     * @param Builder $builder
     * @param null $exclude виключити замовлення з підрахунку
     * @return Builder
     */
    public function scopeCountAvailableRemains(Builder $builder, $exclude = null)
    {
        return $builder->withCount(['orderProduct as countAvailableRemains' => function($query) use($exclude) {
            $query->select(\DB::raw('(syllables.remains-COALESCE(SUM(count),0)) AS c'))->whereHas('order', function ($query) use($exclude){
                $query->where('status', '=', Order::STATUS_PROCESSING)->orWhere('status', '=', Order::STATUS_PENDING);
                if ($exclude) $query->where('id', '<>', $exclude);
            });
        }]);
    }

    /**
     * Відсіювання елемнтів в яких кількість доступних товарів менша нуля
     * havingCountAvailableRemains
     * @param Builder $builder
     * @param null $exclude виключити замовлення з підрахунку
     * @return Builder
     */
    public function scopeHavingCountAvailableRemains(Builder $builder, $exclude = null)
    {
        return $this->scopeCountAvailableRemains($builder, $exclude)->havingRaw('countAvailableRemains > 0');
    }


    /**
     * Відсіювання елемнтів в яких кількість товарів на розляді більша загальної кількості
     * havingCountProcessed
     *
     * @param Builder $builder
     * @param null $exclude виключити замовлення з підрахунку
     * @return Builder
     */
    public function scopeHavingCountProcessed(Builder $builder, $exclude = null)
    {
        return $this->scopeCountProcessed($builder, $exclude)->havingRaw('countProcessed < remains');
    }
}
