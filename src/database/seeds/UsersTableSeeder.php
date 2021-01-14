<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $demo = factory(App\User::class)
      ->create([
        'name' => 'Corpus Demo',
        'email' => 'demo@corpus.dom',
        'password' => bcrypt('demo'),
        'email_verified_at' => new DateTime(),
        ]);

        // $newusers = factory(App\User::class, 2)->create();
    }
}
