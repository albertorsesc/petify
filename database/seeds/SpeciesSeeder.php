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
            
            /** Mamiferos */
            [
                'name' => 'perro',
                'display_name' => 'Perro'
            ],
            [
                'name' => 'Gato',
                'display_name' => 'Gato'
            ],
            [
                'name' => 'Conejo',
                'display_name' => 'Conejo'
            ],
            [
                'name' => 'Conejillo de indias',
                'display_name' => 'Conejillo de indias'
            ],
            [
                'name' => 'Hámster',
                'display_name' => 'Hámster'
            ],
            [
                'name' => 'Raton',
                'display_name' => 'Raton'
            ],
            [
                'name' => 'Rata',
                'display_name' => 'Rata'
            ],
            
            [
                'name' => 'Tortuga',
                'display_name' => 'Tortuga'
            ],
            
            [
                'name' => 'Perico',
                'display_name' => 'Perico'
            ],
        ];
        
        \App\Models\Species::insert($animales);
    }
}
