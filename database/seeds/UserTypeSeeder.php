<?php

use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userTypes = [
            [
                'name' => 'root',
                'display_name' => '#Root',
            ],
            [
                'name' => 'standard-user',
                'display_name' => 'Usuario Regular',
            ],
        ];

        App\Models\UserType::insert($userTypes);
    }
}
