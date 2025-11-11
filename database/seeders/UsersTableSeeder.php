<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id'                => 1,
                'name'              => 'Admin',
                'email'             => 'admin@gmail.com',
                'password'          => '$2y$10$/RDyoZxrCfd4zjqQpuWITuV1/OGMmRdbR6yeAm3lgQpUeD.rsPGiu',
                'is_active'         => true,
                'created_at'        => new \DateTime(),
                'updated_at'        => NULL,
                'is_active'         => TRUE,
                'is_suspended'      => FALSE,
            ]
        ];

        User::insert($users);
    }
}
