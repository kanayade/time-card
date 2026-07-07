<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '一般ユーザー',
            'email' => 'user@coachtech.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ];
        DB::table('users')->insert($param);
            $param = [
            'name' => '管理者',
            'email' => 'admin@coachtech.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '西 伶奈',
            'email' => 'reina.n@coachtech.com',
            'password' => Hash::make('password'),
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '山田 太郎',
            'email' => 'taro.y@coachtech.com',
            'password' => Hash::make('password')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '増田 一世',
            'email' => 'issei.m@coachtech.com',
            'password' => Hash::make('password')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '山本 敬吉',
            'email' => 'keikichi.y@coachtech.com',
            'password' => Hash::make('password')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '秋田 朋美',
            'email' => 'tomomi.a@coachtech.com',
            'password' => Hash::make('password')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '中西 教夫',
            'email' => 'norio.n@coachtech.com',
            'password' => Hash::make('password')
        ];
        DB::table('users')->insert($param);
    }
}
