<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $locale
 * @property string $attribute
 * @property string $value
 * @property int $product_id
 *
 */

class ProductLocalization extends Model
{
    protected $table = 'product_localizations';
    protected $fillable = ['locale', 'product_id', 'attribute', 'value'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
