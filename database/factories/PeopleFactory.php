<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Person;
use Faker\Generator as Faker;
use Faker\Factory;

//$factory->define(Person::class, function () {
//    $faker = Factory::create('zh_CN');
//    $sex = ['MAN', 'WOMEN'];
//
//    return [
//        'name' => $faker->unique()->name,
//        'sex' => $sex[array_rand($sex)],
//        'mobile' => $faker->unique()->phoneNumber,
//        'email' => $faker->unique()->safeEmail,
//        'password' => $faker->unique()->md5,
//        'real_name' => $faker->unique()->name
//    ];
//});

$factory->define(Person::class, function (Faker $faker) {
    $sex = ['MAN', 'WOMEN'];

    return [
        'name' => $faker->unique()->name,
        'sex' => $sex[array_rand($sex)],
        'mobile' => $faker->unique()->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'password' => $faker->unique()->md5,
        'real_name' => $faker->unique()->name
    ];
});
