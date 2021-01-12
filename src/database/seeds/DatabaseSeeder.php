<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        //
        // $this->call(CollectionsTableSeeder::class);
        //
        // $this->call(TextsTableSeeder::class);
        //
        // $this->call(TagsTableSeeder::class);
        //
        // $this->call(AnnouncementsTableSeeder::class);
        //
        // $this->call(LabelsTableSeeder::class);
    }
}
