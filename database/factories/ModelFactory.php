<?php

/**
 * Database Seed Factory
 * 
 * Contains instruction on what kind of seed data is to be created for Users
 *(Guests and Employees)
 */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'phone' => $faker->PhoneNumber,
        'email' => $faker->unique()->safeEmail,
        'company' => $faker->company,
    ];
});

/**
 * Database Seed Factory
 * 
 * Contains instruction on what kind of seed data is to be created for Administrators.
 */
$factory->define(App\Admin::class, function (Faker\Generator $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'remember_token' => str_random(10),
    ];
});

/**
 * Database Seed Factory
 * 
 * Contains instruction on what chance the status is to be set as true or false.
 */
$factory->define(App\Status::class, function (Faker\Generator $faker) {
	return [
		'status' => $faker->boolean($chanceOfGettingTrue = 20),
	];
});

/**
 * Database Seed Factory
 * 
 * Contains instruction on what kind of seed data is to be created for the visit entries.
 */
$factory->define(App\Visit::class, function (Faker\Generator $faker) {
	return [
        'employee_firstname' => $faker->firstName,
        'employee_lastname' => $faker->lastName,
        'from' => $faker->dateTimeAD($max = 'now', $timezone = date_default_timezone_get()),
        'to' => $faker->dateTimeAD($max = 'now', $timezone = date_default_timezone_get()),
	];
});
