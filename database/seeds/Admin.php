<?php

use Illuminate\Database\Seeder;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=[
                  [
                    'name'=>"Marungsha",
                    "email"=>'marungshanew@gmail.com',
                    'password'=>bcrypt('123456')
                  ]
               ];
               
        foreach ($users as $key => $user) {
            if(!App\User::where('email',$user['email'])->first()){
                $user=App\User::firstOrCreate($user);
                $user->roles()->attach([1,2]);
            }
        }
        
    }
}
