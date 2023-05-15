<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        $this->call([
            User::class,
            Role::class,
            Permission::class,
            PermissionRole::class,
            RoleUser::class,
        ]);

    }
}
