<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Models\Users;
use App\Http\Repositories\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(Users $user){
        $this->model = $user;
    }

    public function login($request){
    	$data = [
    		'email' => $request->email,
    		'password' => $request->password
    	];

    	if(Auth::attempt($data)){
    		$user = Auth::user();
    		//CREATE TOKEN
    		$tokenResult = $user->createToken('arb-token');
        	$token = $tokenResult->token;
        	$token->save();

        	return $this->json_response(true, 200, __('system.user.login.success'), $user, ['access_token' => $tokenResult->accessToken]);
    	}
    	return $this->json_response(false, 401, __('system.user.login.invalid'));
    }

    public function logout(){
    	if(Auth::user()->token()->revoke()) 
    		return $this->json_response(true, 200, __('system.user.logout.success'));

    	return $this->json_response(false, 401, __('system.default_error'));
    }

    public function create_data($request){
    	//PASSWORD will be set as "password" by default
    	$data = [
    		'name'		=> $request->name,
    		'email'		=> $request->email,
    		'role_id'	=> $request->role_id,
    		'password'	=> 'password'
    	];

    	$create = $this->create($data);
    	if($create) 
    		return $this->json_response(true, 200, __('system.user.create.success'), $create);

    	return $this->json_response(false, 500, __('system.default_error'));
    }

    public function update_data($request, $id){
    	$user = Auth::user();
    	if(isset($user->role->name) && strtolower($user->role->name) != 'administrator') 
    		return $this->json_response(false, 403, __('system.default_error'));

    	$data = [
    		'name'		=> $request->name,
    		'email'		=> $request->email,
    		'role_id'	=> $request->role_id
    	];
    	
    	$update = $this->update($data, $id);
    	if($update) 
    		return $this->json_response(true, 200, __('system.user.update.success'), $update);

    	return $this->json_response(false, 500, __('system.default_error'));
    }

    public function delete_data($id){
    	$delete = $this->delete($id);
    	if($delete) 
    		return $this->json_response(true, 200, __('system.user.delete.success'));

    	return $this->json_response(false, 500, __('system.default_error'));
    }

    public function all_data(){
    	$all = $this->all();
    	if($all) 
    		return $this->json_response(true, 200, null, $all);

    	return $this->json_response(false, 500, __('system.default_error'));
    }

    public function get_user(){
        $user = Auth::user();
        if($user) 
            return $this->json_response(true, 200, null, $user);

        return $this->json_response(false, 500, __('system.default_error'));
    }

    public function show_data($id){
        $show = $this->show($id);
        if($show) 
            return $this->json_response(true, 200, null, $show);

        return $this->json_response(false, 500, __('system.default_error'));
    }

    public function change_password($request){
        $user = Auth::user();
        if(!Hash::check($request->current_password, $user->password))
            return $this->json_response(false, 500, __('system.user.change_password.invalid_password'));

        $user->password = $request->new_password;
        $user->save();
        return $this->json_response(true, 200, __('system.user.change_password.success'), $user);
    }
}
