<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'uuid' => '07560893-515e-4cad-b0e9-12e247e1a3f6',
                'first_name' => 'Alberto',
                'last_name' => 'Rosas',
                'user_type_id' => 1,
                'email' => 'arosas@petify.com',
                'phone' => '6862894998',
                'password' => bcrypt('password'),
                'status' => true,
            ]
        ];
    
        App\Models\User::insert($users);
    }
}
