<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
class RecordTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->record = factory('App\Record')->create();
    }

    /** @test */
    public function user_can_browse_all_records()
    {
        $response = $this->get('/records');
        $response->assertStatus(200);
    }

    
}
