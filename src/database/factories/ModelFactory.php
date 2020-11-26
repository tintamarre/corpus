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

// $factory = Faker\Factory::create('fr_FR')
$factory->define(App\Models\Collection::class, function (Faker\Generator $faker) {
    $name = $faker->catchPhrase;

    return [
    'name' => $name,
    'description' => $faker->realText($nbWords = 20, $variableNbWords = true),
    ];
});

$factory->define(App\Models\Text::class, function (Faker\Generator $faker) {
    $name = $faker->catchPhrase;

    return [
    'name' => $name,
    'abstract' => str_replace(".", "", $faker->realText($nbWords = 200)),
    ];
});

$factory->define(App\Models\Segment::class, function (Faker\Generator $faker) {
    return [
    'content' => $faker->realText($maxNbChars = 10000, $indexSize = 2),
    ];
});

$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    $tags = config('core_settings.tags');
    $colors = config('core_settings.colors');

    return [
    'name' => $tags[array_rand($tags)],
    'description' => $faker->realText($nbWords = 100, $variableNbWords = true),
    'color' => $colors[array_rand($colors)],
    ];
});

$factory->define(App\Models\Label::class, function (Faker\Generator $faker) {
    $labels = config('core_settings.labels');

    $rand = array_rand($labels);

    return [
    'name' => $labels[$rand]['name'],
    'format' => $labels[$rand]['format'],
    'description' => $labels[$rand]['default_description'],
    ];
});

$factory->define(App\Models\LabelText::class, function (Faker\Generator $faker) {
    return [
    'attribute' => $faker->word,
    ];
});

$factory->define(App\Models\Announcement::class, function (Faker\Generator $faker) {
    return [
    'title' => str_replace(".", "", $faker->realText($nbWords = 50)),
    'body' => $faker->realText($maxNbChars = 2000, $indexSize = 2),
    ];
});
