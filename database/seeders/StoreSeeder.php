<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=3;$i<6;$i++){
            $user = new Store();
            $user->name = 'store user '.$i;
            $user->merchant_id = $i;
            $user->save();
        }

    }
}
