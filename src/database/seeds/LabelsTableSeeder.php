<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class LabelsTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run(Faker $faker)
    {
        $collections = \App\Models\Collection::with('texts')->get();

        // Creating Labels
        foreach ($collections as $col) {
            $rand = rand(4, 7);

            for ($i=0; $i < $rand; $i++) {
                $lab1 = factory(App\Models\Label::class)->make();

                $lab2 = \App\Models\Label::firstOrNew([
          'collection_id' => $col->id,
          'name' => $lab1->name,
        ]);
                $lab2->format = $lab1->format;
                $lab2->description = $lab1->description;
                $lab2->save();
            }

            foreach ($col->texts as $text) {
                $rand = rand(1, 3);

                for ($i=0; $i < $rand; $i++) {
                    $label = \App\Models\Label::whereCollectionId($col->id)->inRandomOrder()->first();

                    switch ($label->format) {
            case 'string':
            switch ($label->name) {
              case 'project_phase':
              $attribute = 'WP' . rand(1, 15);
              break;
              case 'paper_sample':
              $attribute = $faker->catchPhrase;
              break;
              case 'book_sample':
              $attribute = $faker->catchPhrase;
              break;
              default:
              $attribute = $faker->name;
              break;
            }
            break;
            case 'datetime':
            $attribute = $faker->dateTime;
            break;
            case 'int':
            $attribute = rand(1, 15);
            break;
            default:
            $attribute = 'trigu';
            break;
          }

                    $label->label_texts()->save(factory(App\Models\LabelText::class)->make(['text_id' => $text->id, 'attribute' => $attribute]));

                    // \App\Models\LabelText::create([
          // 'label_id' => $label->id,
          // 'text_id' => $text->id,
          // ]);
                }
            }
        }
    }
}
