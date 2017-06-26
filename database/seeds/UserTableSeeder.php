<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_moderator = Role::where('name', 'moderator')->first();
        $role_manager  = Role::where('name', 'manager')->first();
        $moderator = new User();
        $moderator->name = 'Moderator Name';
        $moderator->email = 'moderator@example.com';
        $moderator->password = bcrypt('moderatorsecret');
        $moderator->save();
        $moderator->roles()->attach($role_moderator);


        $manager = new User();
        $manager->name = 'Manager Name';
        $manager->email = 'manager@example.com';
        $manager->password = bcrypt('managersecret');
        $manager->save();
        $manager->roles()->attach($role_manager);
    }
}
