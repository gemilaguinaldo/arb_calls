<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Repositories\RoleRepository;

use App\Http\Requests\Roles\CreateRequest;
use App\Http\Requests\Roles\UpdateRequest;

class RoleController extends Controller
{

	public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }

    public function index(){
        return $this->role->all_data();
    }

    public function store(CreateRequest $request){
        return $this->role->create_data($request);
    }

    public function update(UpdateRequest $request, $id){
        return $this->role->update_data($request, $id);
    }

    public function destroy($id){
        return $this->role->delete_data($id);
    }

    public function show($id){
        return $this->role->show_data($id);
    }
}
