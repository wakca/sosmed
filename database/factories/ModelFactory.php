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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\ProyekDesa::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'desa' => '3205170015',
        'judul'=>$faker->sentence,
        'tahun'=>$faker->year,
        'konten'=>$faker->paragraph
    ];
});
$factory->define(App\OrganisasiDesa::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'desa' => '3205120011',
        'judul'=>$faker->sentence,
        'konten'=>$faker->paragraph
    ];
});

$factory->define(App\PesanWarga::class, function (Faker\Generator $faker) {
    return [
        'desa_id' => '3205120011',
        'nama_lengkap'=>$faker->name,
        'email'=>$faker->email,
        'subjek'=>$faker->sentence,
        'pesan'=>$faker->paragraph
    ];
});
