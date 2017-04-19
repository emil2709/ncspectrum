<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'phone' => $faker->PhoneNumber,
        'email' => $faker->unique()->safeEmail,
        'company' => $faker->company,
    ];
});

$factory->define(App\Admin::class, function (Faker\Generator $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Status::class, function (Faker\Generator $faker) {
	return [
		'status' => $faker->boolean($chanceOfGettingTrue = 20),
	];
});

$factory->define(App\Visit::class, function (Faker\Generator $faker) {
	return [
        'employee_firstname' => $faker->firstName,
        'employee_lastname' => $faker->lastName,
        'from' => $faker->dateTimeAD($max = 'now', $timezone = date_default_timezone_get()),
        'to' => $faker->dateTimeAD($max = 'now', $timezone = date_default_timezone_get()),
	];
});
