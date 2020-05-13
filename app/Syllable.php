<?php

namespace App;

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
    protected $fillable = ['imported', 'remains', 'processed', 'product_id', 'supplier_id', 'description'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
