<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $table = 'purchase_details';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
