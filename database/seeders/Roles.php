<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Roles extends Seeder
{
    public function run() {
        if (DB::table('roles')->get()->count() == 0) {
            DB::table('roles')->insert([
                [
                    'name' => 'Admin',
                    'slug' => 'admin',
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Author',
                    'slug' => 'author',
                    'created_at' => date('Y-m-d H:i:s')
                ],
            ]);
        } else {
            echo "\e[User não é uma tabela vazia. Não foi efetuado o Seed.";
        }
    }
}
