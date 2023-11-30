<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Task;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'nombre' => $faker->sentence,
        'completada' => $faker->boolean,
        'usuario_id' => function () {
            return User::factory()->create()->id;
        },
    ];
});
