<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'total',
        'comment',
        'pay',
        'status',
        'hash'
    ];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }

    public function product()
    {
//        return $this->belongsToMany(Product::class)
//            ->withPivot('amount', 'price');
        return $this->belongsToMany(Product::class);
    }
}
