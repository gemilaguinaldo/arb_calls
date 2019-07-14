<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Roles;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$roles = [
    		[
    			'name' 			=> 'Administrator',
    			'description'	=> 'Super User',
        		'created_at'	=> date('Y-m-d H:i:s'),
        		'updated_at'	=> date('Y-m-d H:i:s')
    		],
    		[
    			'name'			=> 'User',
    			'description'	=> 'Can add expenses',
        		'created_at'	=> date('Y-m-d H:i:s'),
        		'updated_at'	=> date('Y-m-d H:i:s')
    		]
    	];

        Roles::insert($roles);
    }
}
