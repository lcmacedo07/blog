<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Users extends Seeder
{

    public function run() {
        if (DB::table('users')->get()->count() == 0) {
            DB::table('users')->insert([
                [
                    'role_id' => '1',
                    'name' => 'Admin',
                    'username' => 'admin',
                    'email' => 'admin@blog.com',
                    'password' => (new BcryptHasher)->make('123456'),
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'role_id' => '2',
                    'name' => 'Author',
                    'username' => 'author',
                    'email' => 'author@blog.com',
                    'password' => (new BcryptHasher)->make('123456'),
                    'created_at' => date('Y-m-d H:i:s')
                ],
            ]);
        } else {
            echo "\e[User não é uma tabela vazia. Não foi efetuado o Seed.";
        }
    }
}