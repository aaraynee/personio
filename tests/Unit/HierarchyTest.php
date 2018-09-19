<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HierarchyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        // Set input data
        $data = ["Pete"=> "Nick"];

        // Make post request to hierarchy endpoint
        $response = $this->post('/api/hierarchy', $data);

        // Check for response status
        $response->assertStatus(200);

        // Check to see if JSON Structure matches
        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [[ '*' => []]]
            ]);
    }
}
