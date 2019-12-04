<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert(array(
            'name' => 'admin',
            'display_name' => 'Display role admin',
            'description' => 'full permission in the system'
        ));
        Role::insert(array(
            'name' => 'manager',
            'display_name' => 'Display manager',
            'description' => 'review model in the system'
        ));
        Role::insert(array(
            'name' => 'user',
            'display_name' => 'Display user',
            'description' => 'only access to frontend, will define the list of functions later'
        ));
    }
}
