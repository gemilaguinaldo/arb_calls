<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\ExpenseCategoryRepositoryInterface;
use App\Http\Models\ExpenseCategories;
use App\Http\Repositories\Repository;
use Illuminate\Support\Facades\Auth;

class ExpenseCategoryRepository extends Repository implements ExpenseCategoryRepositoryInterface
{
    protected $model;

    public function __construct(ExpenseCategories $expense_category){
        $this->model = $expense_category;
    }

    public function create_data($request){
    	$data = [
    		'name'			=> $request->name,
    		'description'	=> $request->description
    	];

    	$create = $this->create($data);
    	if($create) 
    		return $this->json_response(true, 200, __('system.expense_category.create.success'), $create);

    	return $this->json_response(false, 500, __('system.default_error'));
    }

    public function update_data($request, $id){
    	$user = Auth::user();
    	if(isset($user->role->name) && strtolower($user->role->name) != 'administrator') 
    		return $this->json_response(false, 403, __('system.default_error'));

    	$data = [
    		'name'			=> $request->name,
    		'description'	=> $request->description
    	];
    	
    	$update = $this->update($data, $id);
    	if($update) 
    		return $this->json_response(true, 200, __('system.expense_category.update.success'), $update);

    	return $this->json_response(false, 500, __('system.default_error'));
    }

    public function delete_data($id){
    	$delete = $this->delete($id);
    	if($delete) 
    		return $this->json_response(true, 200, __('system.expense_category.delete.success'));

    	return $this->json_response(false, 500, __('system.default_error'));
    }

    public function all_data(){
    	$all = $this->all();
    	if($all) 
    		return $this->json_response(true, 200, null, $all);

    	return $this->json_response(false, 500, __('system.default_error'));
    }

    public function show_data($id){
        $show = $this->show($id);
        if($show) 
            return $this->json_response(true, 200, null, $show);

        return $this->json_response(false, 500, __('system.default_error'));
    }
}
