<?php

use Illuminate\Database\Seeder;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@mail.com',
            'password' => '$2y$10$Q748xkIoXoKaFu1.hjFh6ONjHgpHp864f9akLmk33WlsTIsnTNn76', //B1tchpl3as3@!
        ]);
    }
}
