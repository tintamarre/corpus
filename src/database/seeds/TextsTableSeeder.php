<?php

use Illuminate\Database\Seeder;

class TextsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collections = \App\Models\Collection::get();

        foreach ($collections as $col) {
            $rand = rand(10, 20);
            for ($i=0; $i < $rand; $i++) {
                $col->texts()->save(factory(App\Models\Text::class)->make());
            }
        }

        $texts = \App\Models\Text::get();

        foreach ($texts as $text) {
            $rand = rand(2, 5);

            $uploader = \App\Models\CollectionUser::whereCollectionId($text->collection_id)->inRandomOrder()->first();

            $text->uploader_id = $uploader->user_id;

            $text->save();

            for ($i=0; $i < $rand; $i++) {
                $text->segments()->save(factory(App\Models\Segment::class)->make(['position' => $i]));
            }
        }
    }
}
