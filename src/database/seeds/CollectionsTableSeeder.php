<?php

use Illuminate\Database\Seeder;

class CollectionsTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $users = \App\User::get();

        // Create collection from admin
        $users->each(function ($u) {
            $rand = rand(1, 6);
            for ($i=0; $i < $rand; $i++) {
                $u->collections()->save(factory(\App\Models\Collection::class)->make());
            }
        });

        $collection_users = \App\Models\CollectionUser::get();

        foreach ($collection_users as $c_u) {
            $c_u->role = 'admin';
            $c_u->save();
        }

        foreach (\App\Models\Collection::get() as $collection) {
            foreach (
        \App\User::whereNotIn(
            'id',
            $collection->users()->pluck('users.id')
        )
        ->take(rand(1, 2))
        ->get()
        ->pluck('id') as $user_id) {
                $collection->users()->attach(
                    $user_id,
                    ['role' => 'member']
                );
            }
        }
    }
}
