<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Coupon;
use Faker\Generator as Faker;

$factory->define(Coupon::class, function (Faker $faker) {
    return [
        'code' => $faker->randomNumber(6),
        'value' => $faker->randomFloat(2, 50, 250),
        'type'   => $faker->randomElement($array = array ('percent','fixed'))
    ];
});
