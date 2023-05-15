<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('roles')->get()->count() == 0) {
            DB::table('roles')->insert([
                [
                    'id' => 1,
                    'name' => 'SUPERADMIN',
                    'description' => 'Perfil com acesso a todos os controles do sistema.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 2,
                    'name' => 'AUTOR',
                    'description' => 'Perfil com acesso a criação de novos posts',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
            ]);
        } else {
            echo "\e[31mRoles não é uma tabela vazia. Não foi efetuado o Seed.";
        }
    }

}
