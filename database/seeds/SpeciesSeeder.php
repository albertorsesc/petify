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
            ],
            [
                'name' => 'Gato',
            ],
            [
                'name' => 'Conejo',
            ],
            [
                'name' => 'Conejillo de indias',
            ],
            [
                'name' => 'Hámster',
            ],
            [
                'name' => 'Raton',
            ],
            [
                'name' => 'Rata',
            ],
            
            [
                'name' => 'Tortuga',
            ],
            
            [
                'name' => 'Perico',
            ],
        ];
        
        \App\Models\Species::insert($animales);
    }
}
