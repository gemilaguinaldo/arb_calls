<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\ExpenseRepositoryInterface;
use App\Http\Models\Expenses;
use App\Http\Repositories\Repository;
use Illuminate\Support\Facades\Auth;

class ExpenseRepository extends Repository implements ExpenseRepositoryInterface
{
    protected $model;

    public function __construct(Expenses $expense){
        $this->model = $expense;
    }

    public function create_data($request){
        $user = Auth::user();
    	$data = [
            'user_id'                 => $user->id,
    		'expense_category_id'     => $request->expense_category_id,            
            'amount'                  => $request->amount,
            'entry_date'              => date('Y-m-d', strtotime($request->entry_date))
    	];

    	$create = $this->create($data);
    	if($create) 
    		return $this->json_response(true, 200, __('system.role.create.success'), $create);

    	return $this->json_response(false, 500, __('system.default_error'));
    }

    public function update_data($request, $id){
    	$user = Auth::user();

    	$data = [
            'user_id'                 => $user->id,
            'expense_category_id'     => $request->expense_category_id,            
            'amount'                  => $request->amount,
            'entry_date'              => date('Y-m-d', strtotime($request->entry_date))
    	];
    	
    	$update = $this->update($data, $id);
    	if($update) 
    		return $this->json_response(true, 200, __('system.role.update.success'), $update);

    	return $this->json_response(false, 500, __('system.default_error'));
    }

    public function delete_data($id){
    	$delete = $this->delete($id);
    	if($delete) 
    		return $this->json_response(true, 200, __('system.role.delete.success'));

    	return $this->json_response(false, 500, __('system.default_error'));
    }

    public function expense_category(){
        $user = Auth::user();
    	$all = $this->model->select(['expenses.expense_category_id','expense_categories.name as category_name'])
                           ->selectRaw('SUM(expenses.amount) as total')
                           ->where('expenses.user_id', $user->id)
                           ->groupBy('expenses.expense_category_id')
                           ->join('expense_categories','expenses.expense_category_id','=','expense_categories.id')
                           ->get();
                           
    	if($all){
            $grand_total = $all->sum('total');
            $all = $all->map(function($item) use ($grand_total){
                $item->percentage = ($item->total / $grand_total) * 100;
                return $item;
            });

            $graph = [];
            foreach ($all as $item) {
                $graph[] = ['label' => $item->category_name, 'value' => $item->percentage];
            }
            
    		return $this->json_response(true, 200, null, $all, ['graph' => $graph]);
        }

    	return $this->json_response(false, 500, __('system.default_error'));
    }

    public function all_data(){
        $user = Auth::user();
        $all = $this->all_where(['user_id' => $user->id]);
                           
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
