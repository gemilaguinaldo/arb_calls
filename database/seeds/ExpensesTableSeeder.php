<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Expenses;

class ExpensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $expenses = [
    		[
                'user_id'               => 1,
        		'expense_category_id'	=> 1,
        		'amount'				=> 100,
        		'entry_date'			=> date('Y-m-d', strtotime('01/01/2019')),
        		'created_at' 			=> date('Y-m-d H:i:s'),
        		'updated_at' 			=> date('Y-m-d H:i:s')
    		],
    		[
                'user_id'               => 1,
        		'expense_category_id'	=> 2,
        		'amount'				=> 200,
        		'entry_date'			=> date('Y-m-d', strtotime('02/01/2019')),
        		'created_at' 			=> date('Y-m-d H:i:s'),
        		'updated_at' 			=> date('Y-m-d H:i:s')
    		],
    		[
                'user_id'               => 2,
        		'expense_category_id'	=> 1,
        		'amount'				=> 300,
        		'entry_date'			=> date('Y-m-d', strtotime('03/01/2019')),
        		'created_at' 			=> date('Y-m-d H:i:s'),
        		'updated_at' 			=> date('Y-m-d H:i:s')
    		],
    		[
                'user_id'               => 2,
        		'expense_category_id'	=> 2,
        		'amount'				=> 400,
        		'entry_date'			=> date('Y-m-d', strtotime('04/01/2019')),
        		'created_at' 			=> date('Y-m-d H:i:s'),
        		'updated_at' 			=> date('Y-m-d H:i:s')
    		]
    	];

        Expenses::insert($expenses);
    }
}
