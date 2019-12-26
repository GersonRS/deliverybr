<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'address',
        'city',
        'state',
        'zipcode',
        'complement',
        'user_id'
    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
