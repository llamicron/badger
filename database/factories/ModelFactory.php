<?php

// TODO: Fix my factory snippet

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'token' => bcrypt(md5($faker->safeEmail) . md5(time())),
        'verified' => false,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Counselor::class, function (Faker\Generator $faker) {
  return [
    'first_name' => $faker->firstName,
    'last_name' => $faker->lastName,
    'email' => $faker->safeEmail,
    'phone' => $faker->phoneNumber,
    'unit_num' => $faker->randomNumber(rand(3, 4)),
    'bsa_id' => $faker->randomNumber(9),
    'unit_only' => $faker->boolean,
    'ypt' => $faker->boolean,
  ];
});

$factory->define(App\Badge::class, function (Faker\Generator $faker) {
  return [
    'name' => $faker->word,
    'code' => rand(1, 150),
  ];
});

$factory->define(App\District::class, function (Faker\Generator $faker) {
  return [
    'name' => $faker->company,
  ];
});