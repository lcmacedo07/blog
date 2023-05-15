<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Permission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('permissions')->get()->count() == 0) {
            DB::table('permissions')->insert([

                /* permissão egral de administrador (ADMIN) */
                [
                    'id' => 1,
                    'name' => 'super',
                    'description' => 'Perfil implantador GestaoBytes',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 2,
                    'name' => 'users',
                    'description' => 'Permissão para cadastro de usuários.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 3,
                    'name' => 'roles',
                    'description' => 'Permissão para cadastrar os papeis de usuários (ACL).',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 4,
                    'name' => 'permissions',
                    'description' => 'Permissão para cadastrar as permissões de usuários (ACL).',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 5,
                    'name' => 'categories',
                    'description' => 'Permissão para cadastrar as categorias.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 6,
                    'name' => 'tags',
                    'description' => 'Permissão para cadastrar as tags.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 7,
                    'name' => 'posts',
                    'description' => 'Permissão para cadastrar os posts.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 8,
                    'name' => 'settings',
                    'description' => 'Permissão para alterar o usuario.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 9,
                    'name' => 'comments',
                    'description' => 'Permissão para excluir os comentarios.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
            ]);
        } else {
            echo "\e[31mPermission não é uma tabela vazia. Não foi efetuado o Seed.";
        }
    }
}
