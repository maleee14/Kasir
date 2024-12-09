<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
