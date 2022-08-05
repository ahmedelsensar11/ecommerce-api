<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $store_id = 0;
        for($i=1;$i<4;$i++){
            $user = new Product();
            $user->name = 'product no '.$i;
            $user->store_id = $i;
            $user->desc = 'product desc no '.$i;
            $user->price = $i.'00.50';
            $user->quantity = $i.'0';
            $user->save();
        }

    }
}
