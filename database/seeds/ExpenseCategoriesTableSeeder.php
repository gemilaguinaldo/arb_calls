<?php

use Illuminate\Database\Seeder;
use App\Http\Models\ExpenseCategories;

class ExpenseCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$categories = [
    		[
    			'name'			=> 'Travel',
        		'description'	=> 'Daily commmute',
        		'created_at' 	=> date('Y-m-d H:i:s'),
        		'updated_at' 	=> date('Y-m-d H:i:s')
    		],
    		[
    			'name'			=> 'Entertainment',
        		'description'	=> 'Movies etc',
        		'created_at' 	=> date('Y-m-d H:i:s'),
        		'updated_at' 	=> date('Y-m-d H:i:s')
    		]
    	];

        ExpenseCategories::insert($categories);
    }
}
