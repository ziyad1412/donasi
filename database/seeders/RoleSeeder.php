<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::create(['name' => 'owner']);
        $fundraiserRole = Role::create(['name' => 'fundraiser']);
        // $userOwner from user, name,avatar,email,password bcrypt
        $userOwner = User::create([
            'name' => 'Ziyad',
            'avatar' => 'avatars/ziyad.jpg',
            'email' => 'abdurrahman.ziyad17@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $userOwner->assignRole($ownerRole);
    }
}
