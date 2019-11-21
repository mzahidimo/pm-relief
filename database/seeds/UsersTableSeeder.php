<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::Truncate();
        DB::table('role_user')->truncate(); 

        $superaRole = Role::where('name','Super admin')->first();
        $adminRole = Role::where('name','Admin')->first();
        $userRole = Role::where('name','User')->first();

        $supera = user::create([
            'name' => 'Super User',
            'email' => 'super@super.com',
            'password' => Hash::make('11111111')
        ]);

        $admin = user::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('11111111')
        ]);

        $user = user::create([
            'name' => 'Normal User',
            'email' => 'normal@normal.com',
            'password' => Hash::make('11111111')
        ]);

        $supera->roles()->attach($superaRole);
        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);
    }
}
