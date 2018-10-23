<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $board = factory('App\Models\Board')->create();
        User::create([
            'name' => 'Administrador',
            'board_id' => $board->id,
            'email' => 'admin@mail.com',
            'password' => '$2y$10$Q748xkIoXoKaFu1.hjFh6ONjHgpHp864f9akLmk33WlsTIsnTNn76', //B1tchpl3as3@!
        ]);
    }
}
