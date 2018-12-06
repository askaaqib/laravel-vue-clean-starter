<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name'              => $faker->name,
        'email'             => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password'          => bcrypt('secret'),
        'active'            => true,
        'locale'            => app()->getLocale(),
        'timezone'          => config('app.timezone'),
    ];
});


$factory->define(Spatie\Tags\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => [
            'en' => $faker->unique()->word,
            'fr' => $faker->unique()->word,
            'es' => $faker->unique()->word,
            'ar' => $faker->unique()->word,
            'ru' => $faker->unique()->word,
            'de' => $faker->unique()->word,
            'pt' => $faker->unique()->word,
            'zn' => $faker->unique()->word,
        ],
    ];
});

