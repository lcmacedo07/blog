<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('permission_role')->get()->count() == 0) {
            DB::table('permission_role')->insert([
                ['permission_id' => 1, 'role_id' => 1, 'created_at' => date('Y-m-d H:i:s')],
                /** autor */
                ['permission_id' => 7, 'role_id' => 2, 'created_at' => date('Y-m-d H:i:s')],
                ['permission_id' => 8, 'role_id' => 2, 'created_at' => date('Y-m-d H:i:s')],
                ['permission_id' => 9, 'role_id' => 2, 'created_at' => date('Y-m-d H:i:s')],
            ]);
        } else {
            echo "\e[31mPermission_Role não é uma tabela vazia. Não foi efetuado o Seed.";
        }
    }

}
