<?php

return [
	'default_error' => 'Unable to process request. Please try again.',
	'required_fields' => [
		'name' 					=> 'Name is a required field.',
		'description'			=> 'Description is a required field.',
		'password'				=> 'Password is a required field.',
		'email'					=> 'Email is a required field.',
		'role'					=> 'Role is a required field.',
		'user_id'				=> 'User is a required field.',
		'expense_category_id'	=> 'Expense Category is a required field.',
		'amount'				=> 'Amount is a required field.',
		'entry_date'			=> 'Entry Date is a required field.',
		'current_password'		=> 'Current password is a required field.',
		'new_password'			=> 'New password is a required field.',
		'confirm_password'		=> 'Confirm password is a required field.',
	],
	'user' => [
		'login' => [
			'invalid' => 'Invalid Email Address or Password.',
			'success' => 'You have successfully logged in.'
		],
		'logout' => [
			'success' => 'You have successfully logged out.'
		],
		'create' => [
			'success' => 'You have successfully created user.'
		],
		'update' => [
			'success' => 'You have successfully updated user.'
		],
		'delete' => [
			'success' => 'You have successfully deleted a user.'
		],
		'change_password' => [
			'invalid_password' => 'Invalid current password.',
			'success' => 'You have successfully updated your password.'
		],
	],
	'role' => [
		'create' => [
			'success' => 'You have successfully created role.'
		],
		'update' => [
			'success' => 'You have successfully updated role.'
		],
		'delete' => [
			'success' => 'You have successfully deleted a role.'
		]
	],
	'expense_category' => [
		'create' => [
			'success' => 'You have successfully created expense category.'
		],
		'update' => [
			'success' => 'You have successfully updated expense category.'
		],
		'delete' => [
			'success' => 'You have successfully deleted a expense category.'
		]
	],
	'expense' => [
		'create' => [
			'success' => 'You have successfully created expense.'
		],
		'update' => [
			'success' => 'You have successfully updated expense.'
		],
		'delete' => [
			'success' => 'You have successfully deleted an expense.'
		]
	],
];