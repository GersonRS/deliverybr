<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'value',
        'type',
        'establishment_id'
    ];
    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }

}
