<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1;$i<4;$i++){
            $user = new User();
            $user->name = 'User '.$i ;
            $user->phone = '+20'.$i.'2321657';
            $user->email = 'user'.$i.'@gmail.com';
            $user->password = Hash::make('12345'.$i);
            if ($i == 3){
                $user->name = 'Merchant' ;
                $user->is_merchant = true ;
                $user->email = 'merchant11@gmail.com';
            }
            $user->save();
        }
    }
}
