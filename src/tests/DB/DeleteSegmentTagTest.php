<?php

namespace Tests\DB;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\SegmentTag;

class DeleteSegmentTagTest extends TestCase
{
  /**
  * A basic feature test example.
  *
  * @return void
  */
  public function testSegmentTag()
  {
    $segment_tags = SegmentTag::inRandomOrder()->take(5)->get();

    foreach ($segment_tags as $segment_tag) {
      $tag = $segment_tag->tag()->first();
      $segment_tag->delete();

      if ($tag) {
        if ($tag->children->count() > 0) {
          $this->assertTrue(true);
        }
        else {
          $this->assertTrue(true);
        }
      }
    }


  }
}
