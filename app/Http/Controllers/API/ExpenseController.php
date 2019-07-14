<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ExpenseRepository;

use App\Http\Requests\Expenses\CreateRequest;
use App\Http\Requests\Expenses\UpdateRequest;

class ExpenseController extends Controller
{
	public function __construct(ExpenseRepository $expense)
    {
        $this->expense = $expense;
    }

    public function index(){
        return $this->expense->expense_category();
    }

    public function store(CreateRequest $request){
        return $this->expense->create_data($request);
    }

    public function update(UpdateRequest $request, $id){
        return $this->expense->update_data($request, $id);
    }

    public function destroy($id){
        return $this->expense->delete_data($id);
    }

    public function all(){
        return $this->expense->all_data();
    }
    
    public function show($id){
        return $this->expense->show_data($id);
    }
}
