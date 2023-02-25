<?php

namespace Database\Seeders;

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
        User::factory(5)->create()->each(function ($user) {
            $user->assignRole('Vecino');
        });
        User::factory(5)->create()->each(function ($user) {
            $user->assignRole('Usuario');
        });

        User::create(['name'=>'Test', 'email'=>'test@hotmail.com','password'=>bcrypt('12345678')])->assignRole('SuperAdmin');
        User::create(['name'=>'Admin', 'email'=>'Admin@hotmail.com','password'=>bcrypt('12345678')])->assignRole('Admin');
        User::create(['name'=>'Guardia', 'email'=>'guardia@hotmail.com','password'=>bcrypt('12345678')])->assignRole('Guardia');
        User::create(['name'=>'Vecino', 'email'=>'vecino@hotmail.com','password'=>bcrypt('12345678')])->assignRole('Vecino');
        User::create(['name'=>'Usuario', 'email'=>'user@hotmail.com','password'=>bcrypt('12345678')])->assignRole('Usuario');
    }
}
