<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 10)->create(['role_id' => \App\Role::all()->random()->id]);
        /*factory(\App\Role::class, 1)->create(['name' => 'superadmin', 'description' => 'Usuario administrador con todos los permios']);
        factory(\App\Role::class, 1)->create(['name' => 'admin', 'description' => 'Usuario administrador puede editar valores de los estados del banco'])*/;
    }
}
