<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ExpenseCategoryRepository;

use App\Http\Requests\ExpensesCategories\CreateRequest;
use App\Http\Requests\ExpensesCategories\UpdateRequest;

class ExpenseCategoryController extends Controller
{

	public function __construct(ExpenseCategoryRepository $expense_category)
    {
        $this->expense_category = $expense_category;
    }

    public function index(){
        return $this->expense_category->all_data();
    }

    public function store(CreateRequest $request){
        return $this->expense_category->create_data($request);
    }

    public function update(UpdateRequest $request, $id){
        return $this->expense_category->update_data($request, $id);
    }

    public function destroy($id){
        return $this->expense_category->delete_data($id);
    }

    public function show($id){
        return $this->expense_category->show_data($id);
    }
}
