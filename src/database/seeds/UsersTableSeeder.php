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
        $martin = factory(App\User::class)
    ->create([
      'name' => 'Martin Erpicum',
      'email' => 'martin.erpicum@uliege.be',
      'password' => bcrypt('asdf1234[]{}??'),
      'email_verified_at' => new DateTime(),
      ]);

    
      $newusers = factory(App\User::class, 2)->create();
    }
}
