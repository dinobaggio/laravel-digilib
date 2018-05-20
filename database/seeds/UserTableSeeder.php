<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        
        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $role_dosen = Role::where('name', 'dosen')->first();
        
        $dosen = new User();
        $dosen->name = 'Dosen Pintar';
        $dosen->email = 'dosen@example.com';
        $dosen->password = bcrypt('secret');
        $dosen->save();
        $dosen->roles()->attach($role_dosen);

        $role_mahasiswa = Role::where('name', 'mahasiswa')->first();
        
        $mahasiswa = new User();
        $mahasiswa->name = 'Mahasiswa Pintar';
        $mahasiswa->email = 'mahasiswa@example.com';
        $mahasiswa->password = bcrypt('secret');
        $mahasiswa->save();
        $mahasiswa->roles()->attach($role_mahasiswa);
    }
}
