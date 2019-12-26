<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Establishment;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'price' => $faker->randomFloat(2, 10, 50),
        'image' =>$faker->imageUrl(640,480,'food',true,'Faker'),
        'category_id' => Category::all()->random()->id,
        'establishment_id' => Establishment::all()->random()->id,
//        'category_id' => $faker->numberBetween(1, 10),
//        'establishment_id' => $faker->numberBetween(1, 5),
    ];
});
