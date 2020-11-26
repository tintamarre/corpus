<?php

namespace Tests\DB;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Text;

class DeleteTextTest extends TestCase
{
  /**
  * A basic feature test example.
  *
  * @return void
  */
  public function testDeleteText()
  {
    $text = Text::inRandomOrder()->first();
    $text_id = $text->id;
    $text->delete();

    if (\App\Models\Segment::whereText_id($text_id)->get()->count() == 0) {
      $this->assertTrue(true);
    };

    if (\App\Models\LabelText::whereText_id($text_id)->get()->count() == 0) {
      $this->assertTrue(true);
    };


  }
}
