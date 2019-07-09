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
                'status' => true,
            ],
            [
                'name' => 'Gato',
                'status' => true,
            ],
            [
                'name' => 'Conejo',
                'status' => true,
            ],
            [
                'name' => 'Conejillo de indias',
                'status' => true,
            ],
            [
                'name' => 'Hámster',
                'status' => true,
            ],
            [
                'name' => 'Raton',
                'status' => true,
            ],
            [
                'name' => 'Rata',
                'status' => true,
            ],
            
            [
                'name' => 'Tortuga',
                'status' => true,
            ],
            
            [
                'name' => 'Perico',
                'status' => true,
            ],
        ];
        
        \App\Models\Species::insert($animales);
    }
}
