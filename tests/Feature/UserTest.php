<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithoutMiddleware, DatabaseMigrations, DatabaseTransactions;
    /**
     * @test
     */
  /*   public function admin_can_create_other_users()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'secret',
            'sex' => 'Male',
        ];

    } */
}
