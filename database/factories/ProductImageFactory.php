<?php

use Faker\Generator as Faker;
use App\Productimage;

$factory->define(Productimage::class, function (Faker $faker) {
    return [

        'image' => $faker->imageUrl(250,250),
        'product_id' => $faker->numberBetween(1, 100)
    ];
});
