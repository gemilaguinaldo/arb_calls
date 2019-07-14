<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use SoftDeletes, HasApiTokens;

    protected $fillable = [
    	'name',
    	'email',
    	'role_id',
    	'password'
    ];

    protected $hidden = [
        'role_id',
    	'password',
        'updated_at',
        'deleted_at'
    ];

    protected $appends = [
        'role'
    ];

    public function getRoleAttribute(){
        return $this->role()->first();
    }

    public function setPasswordAttribute($value){
    	$this->attributes['password'] = Hash::make($value);
    }

    public function verify_password($password){
        return Hash::check($password, $this->password);
    }

    public function role(){
        return $this->belongsTo('App\Http\Models\Roles');
    }
}
