<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $roles = [
            [
                'id'    => 1,
                'name' => 'Admin',
            ],
            [
                'id'    => 2,
                'name' => 'User',
            ],
            [
                'id'    => 3,
                'name' => 'Musician',
            ],
        ];

        // Role::insert($roles);
        DB::table('roles')->insert($roles);
    }
}
