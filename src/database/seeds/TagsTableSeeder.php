<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collections = \App\Models\Collection::with('segments', 'users')->get();

        // Creating Tags
        foreach ($collections as $col) {
            $rand = rand(10, 17);

            for ($i=0; $i < $rand; $i++) {
                $col->tags()->save(factory(App\Models\Tag::class)->make());
            }

            foreach ($col->segments as $seg) {
                $rand = rand(0, 4);

                for ($i=0; $i < $rand; $i++) {
                    $tag = \App\Models\Tag::whereCollectionId($col->id)->inRandomOrder()->first();

                    $snippet_start = rand(0, strlen($seg->content) - 10);
                    $snippet_end = rand($snippet_start, $snippet_start + rand(0, strlen($seg->content) - $snippet_start));

                    \App\Models\SegmentTag::create([
                        'user_id' => $col->users()->inRandomOrder()->first()->id,
                        'tag_id' => $tag->id,
                        'segment_id' => $seg->id,
                        'text_id' => $seg->text->id,
                        'snippet_start' => $snippet_start,
                        'snippet_end' => $snippet_end,
                        ]);
                }
            }
        }
    }
}
