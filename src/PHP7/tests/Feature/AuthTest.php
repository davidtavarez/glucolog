<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations, WithFaker;

    /**
     * @test
     */
    public function user_can_login()
    {
        \DB::table('oauth_clients')->insert([
            'name' => 'Glucolog',
            'secret' => 'VONOZnlURyWMmLv5wCtqMGCsZFIpRbKMspcy6bG3',
            'redirect' => 'http://localhost',
            'personal_access_client' => 1,
            'password_client' => 0,
            'revoked' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $client = \DB::table('oauth_clients')->first();
        \DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $user = factory('App\Models\User')->create();
        $data = [
            'email' => $user->email,
            'password' => 'secret',
        ];

        return $this->post(route('auth.login'), $data)->assertStatus(200)->assertJsonStructure([
            'access_token', 'token_type', 'expires_at',
        ]);
    }

    /**
     * @test
     */
    public function user_can_logout()
    {
        $response = $this->user_can_login();
        $token = $response->baseResponse->original['access_token'];
        $headers = [
            'Authorization' => 'Bearer ' . $token,
        ];
        $this->post(route('auth.logout'), [], $headers)->assertStatus(200)->assertJson([
            'message' => 'Te has desconectado correctamente.',
        ]);
    }

    /**
     * @test
     */
    public function user_can_register()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'secret',
            'birthday' => $this->faker->date,
            'detection_date' => $this->faker->date,
            'diabetes' => 'Type 1',
            'sex' => 'Male',
        ];

        return $this->post(route('auth.register'), $data)->assertStatus(201)->assertJsonStructure([
            'message', 'user',
        ]);
    }
}
