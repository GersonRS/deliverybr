<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail(int $id)
 * @method static create(array $all)
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'establishment_id'
    ];
    public function category()
    {
        return $this->belongsTo(Category::Class);
    }

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }

    public function order()
    {
        return $this->hasMany(Order::Class);
    }

}
