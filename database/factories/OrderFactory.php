<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use App\Establishment;
use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'address_id' => Address::all()->random()->id,
        'establishment_id' => Establishment::all()->random()->id,
        'total' => $faker->randomFloat(2, 50, 250),
        'pay' => $faker->randomFloat(2, 50, 250),
        'status' => 0
    ];
});
