<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Student;
use App\Service;
use App\Enrollment;
use App\Annuity;

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


        $student = Student::create([
            'name' => 'Julio Monsalve',
            'email' => 'juliomonsalve@gmail.com',
            'idPersonal' => '10424253465',
            'attendant' => 'Karen Monsalve',
            'phone' => '3125354572'
        ]);


        $service = Service::create([
            'name' => 'Segueduc',
            'cost' => 30.50,
            'status' => Service::REQUIRED
        ]);

        $service = Service::create([
            'name' => 'Libros',
            'cost' => 40.50,
            'status' => Service::ACTIVE
        ]);

        $enrollment = Enrollment::create([
            'grade' => '9°',
            'bachelor' => 'Tecnico',
            'cost' => '350.00'
        ]);

        $enrollment = Enrollment::create([
            'grade' => '10°',
            'bachelor' => 'Comercial',
            'cost' => 450.00
        ]);

        $annuity = Annuity::create([
            'year' => 2019,
            'cost' => 3000.00,
            'maximum_date' => '2019-01-20',
            'second_month' => '2018-11-20'
        ]);
    }
}
