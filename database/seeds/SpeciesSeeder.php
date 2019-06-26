<?php

use Illuminate\Database\Seeder;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $animales = [
            [
                'name' => 'perro',
                'display_name' => 'Perro'
            ]
        ];
        
        \App\Models\Species::insert($animales);
    }
}
