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
        for ($i=1;$i<6;$i++){
            $user = new User();
            $user->name = 'User '.$i ;
            $user->phone = '+966'.$i.'2321657';
            $user->email = 'user'.$i.'@gmail.com';
            $user->gender = 'male';
            $user->birth_date = '2022-03-0'.$i;
            $user->password = Hash::make('1234'.$i);
            if ($i == 5){
                $user->name = 'Admin' ;
                $user->is_admin = true ;
                $user->email = 'admin11@gmail.com';
            }
            if ($i == 1){
                $user->subscribed = true ;
            }
            $user->save();
        }
    }
}
