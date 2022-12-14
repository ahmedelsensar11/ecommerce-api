<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $ads = new UserSeeder() ;
        $ads->run();
        $ads = new StoreSeeder() ;
        $ads->run();
        $ads = new ProductSeeder() ;
        $ads->run();
    }

}
