<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'phone' => $faker->PhoneNumber,
        'email' => $faker->unique()->safeEmail,
        'company' => $faker->company,
        //'remember_token' => str_random(10),
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
		'user_id' => $faker->numberBetween($min = 1, $max = 20),
		'status' => $faker->cityPrefix,
	];
});

$factory->define(App\Visit::class, function (Faker\Generator $faker) {
	return [
		'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
		'from' => $faker->time($format = 'H:i:s', $max = 'now'),
		'to' => $faker->time($format = 'H:i:s', $max = 'now'),
		'company' => $faker->company,
		'comment' => $faker->state,
	];
});
