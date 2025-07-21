<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Tata Usaha']);

        $user = User::create([
            'name' => 'Admin EArsip',
            'email' => 'admin@earsip.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole('Admin');
        $user = User::create([
            'name' => 'Tata Usaha EArsip',
            'email' => 'tatausaha@earsip.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole('Tata Usaha');
    }
}
