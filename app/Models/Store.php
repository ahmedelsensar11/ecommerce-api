<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property int $merchant_id
 * @property bool $vat_included
 * @property float $vat_percentage
 * @property float $shipping_cost
 * @property string $created_at
 */

class Store extends Model
{
    protected $table = 'stores';
    protected $fillable = ['name', 'merchant_id', 'vat_included', 'vat_percentage', 'shipping_cost'];

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(User::class,'merchant_id','id');
    }
}
