<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'トマト',
            'eng' => 'tomato',
            'prise' => 220,
            'base' => 6,
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'ベーコン',
            'prise' => 886,
            'base' => 2,
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => '山形パン',
            'prise' => 377,
            'base' => 6,
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'マヨネーズ',
            'prise' => 435,
            'base' => 0.2,
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'マスタード',
            'prise' => 278,
            'base' => 0.3,
        ];
        DB::table('items')->insert($param);
    }
}
