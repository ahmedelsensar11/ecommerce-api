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
        $ads = new CategorySeeder() ;
        $ads->run();
        $ads = new AddressSeeder() ;
        $ads->run();
        $ads = new AdsSeeder() ;
        $ads->run();
        $ads = new ProductSeeder() ;
        $ads->run();
        $ads = new ProductImagesSeeder() ;
        $ads->run();
        $ads = new RatingSeeder() ;
        $ads->run();
        $ads = new AppContactSeeder() ;
        $ads->run();
        $ads = new SupportSeeder() ;
        $ads->run();
        $ads = new StaticPageSeeder() ;
        $ads->run();
        $ads = new SubscriptionTypesSeeder() ;
        $ads->run();
        $ads = new SubscriptionSeeder() ;
        $ads->run();
        $ads = new MessageSeeder() ;
        $ads->run();
        $ads = new FiltersSeeder() ;
        $ads->run();
    }

}
