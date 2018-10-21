<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    
    public function run()
    {
        factory(\App\User::class)->create([
            'first_name' => 'Felipe',
            'last_name' => 'Guzman',
            'username'  => 'fguzman',
            'email'     =>  'felipe.guzman@test.com',
            'role'      => 'admin'
        ]);
    }
}
