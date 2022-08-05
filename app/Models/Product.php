<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property string $desc
 * @property string $price
 * @property int $store_id
 * @property int $quantity
 *
 */

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'store_id', 'desc', 'price', 'quantity'];
    protected $appends = ['available'];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }

    public function getAvailableAttribute(): bool
    {
        if ($this->quantity == 0){
            return false;
        }
        return true;
    }
}
