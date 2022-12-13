<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run():void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@mail.loc',
                'email_verified_at' => '2022-12-10 22:30:15',
                'password' => Hash::make('password'),
                'created_at' => '2022-12-10 22:30:15',
                'updated_at' => '2022-12-10 22:30:15',
                'deleted_at' => NULL
            ],
            [
                'name' => 'Theodor Kowalski',
                'email' => 'tkowalski@mail.loc',
                'email_verified_at' => NULL,
                'password' => Hash::make('password2'),
                'created_at' => '2022-12-10 22:33:15',
                'updated_at' => '2022-12-10 22:33:15',
                'deleted_at' => NULL
            ],
            [
                'name' => 'Anna Nowak',
                'email' => 'anowak@mail.loc',
                'email_verified_at' => NULL,
                'password' => Hash::make('password3'),
                'created_at' => '2022-12-10 22:34:15',
                'updated_at' => '2022-12-10 22:34:15',
                'deleted_at' => '2022-12-10 22:34:15'
            ],
            [
                'name' => 'tester',
                'email' => 'tester@mail.loc',
                'email_verified_at' => NULL,
                'password' => Hash::make('password4'),
                'created_at' => '2022-12-10 22:35:15',
                'updated_at' => '2022-12-10 22:35:15',
                'deleted_at' => NULL
            ],
        ]);
    }
}
