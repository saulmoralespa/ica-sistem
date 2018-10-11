<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            'board-see',
            'board-create',
            'board-cancel',
            'students-see',
            'students-createEdit',
            'students-cancel',
            'payments-see',
            'payments-createEdit',
            'payments-cancel',
            'reports-see',
            'reports-createEdit',
            'reports-cancel',
            'costs-see',
            'costs-createEdit',
            'costs-cancel'

        ];

        foreach ($permissions as $permission) {

            Permission::create(['name' => $permission]);

        }


        $superAdmin = Role::create(['name' => 'SuperAdministrator']);
        $Admin = Role::create(['name' => 'Administrator']);
        $superAdmin->givePermissionTo(Permission::all());

        $user = User::create([
            'name' => 'Saul Morales',
            'username' => 'saulmoralespa',
            'email' => 'cortuclas@gmail.com',
            'password' => bcrypt('pass123#')

        ]);

        $user->assignRole('SuperAdministrator');

        $user = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@hello.com',
            'password' => bcrypt('pass123#')

        ]);

        $user->assignRole('SuperAdministrator');
        $role = Role::find($user->id);
        $role->syncPermissions(Permission::all());
    }
}
