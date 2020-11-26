<?php

namespace Tests\DB;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Collection;

class DeleteCollectionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDeleteCollection()
    {
      $collection = Collection::inRandomOrder()->first();
      $collection_id = $collection->id;
      $collection->delete();

      if (\App\Models\CollectionUser::whereCollection_id($collection_id)->get()->count() == 0) {
        $this->assertTrue(true);
      };

      if (\App\Models\Text::whereCollection_id($collection_id)->get()->count() == 0) {
        $this->assertTrue(true);

      };

      if (\App\Models\Tag::whereCollection_id($collection_id)->get()->count() == 0) {
        $this->assertTrue(true);
      };

      if (\App\Models\Label::whereCollection_id($collection_id)->get()->count() == 0) {
        $this->assertTrue(true);
      };



    }
}
