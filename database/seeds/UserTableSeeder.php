<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'owner2',
            'email' => 'owner@exsample2',
            'password' => Hash::make('owner'),
            'admin' => 30
        ];
        DB::table('users')->insert($param);

    }
}
