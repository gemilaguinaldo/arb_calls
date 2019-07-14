<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'name',
    	'description'
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at'
    ];
}
