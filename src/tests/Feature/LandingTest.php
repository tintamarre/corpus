<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLanding()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
