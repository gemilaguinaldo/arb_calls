<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Users;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
        	[
        		'name'			=> 'Admin',
        		'email'			=> 'admin@admin.com',
        		'role_id'		=> 1,
        		'password'		=> Hash::make('admin'),
        		'created_at'	=> date('Y-m-d H:i:s'),
        		'updated_at'	=> date('Y-m-d H:i:s')
        	],
        	[
        		'name'			=> 'User',
        		'email'			=> 'user@user.com',
        		'role_id'		=> 2,
        		'password'		=> Hash::make('user'),
        		'created_at' 	=> date('Y-m-d H:i:s'),
        		'updated_at' 	=> date('Y-m-d H:i:s')
        	]
        ];
        
        Users::insert($users);
    }
}
