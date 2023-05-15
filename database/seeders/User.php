<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\DB;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run() {
        if (DB::table('users')->get()->count() == 0) {
            DB::table('users')->insert([
                [
                    'name' => 'Admin',
                    'username' => 'admin',
                    'email' => 'admin@blog.com',
                    'password' => (new BcryptHasher)->make('123456'),
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
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
