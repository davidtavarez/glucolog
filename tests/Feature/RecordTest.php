<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RecordTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->record = factory('App\Record')->create();
    }

    /** @test */
    public function user_can_create_record()
    {

    }

    
}
