<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $tagdata = factory(App\Models\Team::class)->create([
      'name' => 'TagData',
      'slug' => 'tagdata',
      'owner_id' => '1',
    ]);

        $spiral = factory(App\Models\Team::class)->create([
      'name' => 'Spiral',
      'slug' => 'spiral',
      'owner_id' => '1',
    ]);

        $othersteams = factory(App\Models\Team::class, 3)
    ->create();

        $teams = App\Models\Team::get();

        foreach ($teams as $team) {
            $team->users()->attach($team->owner_id, ['role' => 'member']);

            $rand = rand(2, 6);

            $teammembers = App\User::inRandomOrder()
      ->limit($rand)
      ->where('id', '<>', $team->owner_id)
      ->pluck('id')
      ->toArray();

            //dd($teammembers);

            $team->users()->attach($teammembers, ['role' => 'member']);

            $teams = \App\Models\Team::get();
            $teams->each(function ($t) {
                $rand = rand(0, 3);
                for ($i=0; $i < $rand; $i++) {
                    $t->collections()->save(factory(App\Models\Collection::class)->make());
                }

                $collections = $t->collections()->get();

                foreach ($collections as $col) {
                    $members = $t->users()->inRandomOrder()->limit(2)->pluck('id')->toArray();
                    $col->users()->attach($members, ['role' => 'member']);
                }
            });
        }
    }
}
