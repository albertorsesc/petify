<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $seeders = [
//        CountrySeeder::class,
//        StateSeeder::class,
        UserTypeSeeder::class,
        UserSeeder::class,
        SpeciesSeeder::class,
//        BusinessTypeSeeder::class,
//        PropertyTypeSeeder::class,
//        PropertyCategorySeeder::class,
//        PropertySeeder::class,
//        UserPropertySeeder::class,
//        PropertyAddressSeeder::class,
//        PropertyFeatureSeeder::class,
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call($this->seeders);
    }
}
