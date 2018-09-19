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
    public function testHierarchy()
    {
        // Set input data
        $data = ["Pete"=> "Nick"];

        // Make post request to hierarchy endpoint
        $response = $this->post('/api/hierarchy', $data);

        // Check for response status
        $response->assertStatus(200);

        // Check to see if JSON Structure matches
        $response->assertJsonStructure([
                '*' => [[ '*' => []]]
            ]);
    }

    public function testLoop()
    {
        // Set input data
        $data = ["Pete"=> "Nick", "Nick" => "Pete"];

        // Make post request to hierarchy endpoint
        $response = $this->post('/api/hierarchy', $data);

        // Check for response status
        $response->assertStatus(200);

        // Check to see if JSON Structure matches
        $response->assertExactJson([
                'Loop exists'
            ]);
    }
}
