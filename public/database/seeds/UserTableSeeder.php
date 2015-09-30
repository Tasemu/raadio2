<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
    		'name' => 'Montague Monro',
    		'email' => 'montymonro1@gmail.com',
    		'password' => Hash::make('test123'),
    		'avatar' => 'http://lorempixel.com/300/300'
    	]);
        factory(App\User::class, 50)->create();
    }
}
