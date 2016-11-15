<?php

use Illuminate\Database\Seeder;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles=['admin','superadmin'];
        foreach ($roles as $key => $role) {
        	\App\Models\Admin\Role::firstOrCreate(['name'=>$role]);
        }
    }
}
