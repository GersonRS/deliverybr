<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 * @method static findOrFail(int $id)
 */
class Establishment extends Model
{
    protected $fillable = [
        'name',
        'name_label',
        'lat',
        'lng',
        'website',
        'mail',
        'address',
        'phone',
        'image',
        'thumbnail',
        'active',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function order()
    {
        return $this->hasMany(Order::Class);
    }
    public function coupon()
    {
        return $this->hasMany(Coupon::Class);
    }
    public function product()
    {
        return $this->hasMany(Product::Class);
    }
}
