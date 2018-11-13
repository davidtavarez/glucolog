<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class RecordTest extends TestCase
{
    use WithFaker, DatabaseMigrations, DatabaseTransactions, WithoutMiddleware;

    /**
     * @test
     */
    public function user_can_create_a_glycemia_record()
    {
        $user = factory('App\Models\User')->create();
        \Auth::login($user);

        $data = [
            'date' => $this->faker->date,
            'time' => $this->faker->time,
            'comment' => $this->faker->sentence,
            'measure' => $this->faker->numberBetween(10, 250),
            'condition' => $this->faker->numberBetween(1, 2),
        ];
        
        $this->post(route('records.store'), $data)->assertStatus(201)->assertJsonStructure([
            'message', 'record',
        ]);
    }

    /**
     * @test
     */
    public function user_can_see_all_records_from_the_last_week()
    {
        $user = factory('App\Models\User')->create();
        $records = factory('App\Models\Record')->create([
            'board_id' => $user->board_id,
            'user_id' => $user->id
        ]);

        \Auth::login($user);

        $this->get(route('records.index'))->assertStatus(200)->assertJsonStructure([
            'records'
        ]);
    }

     /**
     * @test
     */
    public function user_can_see_all_records()
    {
        $user = factory('App\Models\User')->create();
        $records = factory('App\Models\Record')->create([
            'board_id' => $user->board_id,
            'user_id' => $user->id
        ]);

        \Auth::login($user);

        $this->get(route('records.list'))->assertStatus(200)->assertJsonStructure([
            'current_page', 'data', 'total'
        ]);
    }
}
