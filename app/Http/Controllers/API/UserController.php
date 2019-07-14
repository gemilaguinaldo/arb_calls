<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\Users\LoginRequest;
use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Http\Requests\Users\ChangePasswordRequest;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index(){
        return $this->user->get_user();
    }

    public function login(LoginRequest $request){
       return $this->user->login($request);
    }

    public function logout(){
       return $this->user->logout();
    }
    
    public function store(CreateRequest $request){
        return $this->user->create_data($request);
    }

    public function update(UpdateRequest $request, $id){
        return $this->user->update_data($request, $id);
    }

    public function destroy($id){
        return $this->user->delete_data($id);
    }

    public function all(){
        return $this->user->all_data();
    }

    public function show($id){
        return $this->user->show_data($id);
    }

    public function change_password(ChangePasswordRequest $request){
        return $this->user->change_password($request);
    }
}
