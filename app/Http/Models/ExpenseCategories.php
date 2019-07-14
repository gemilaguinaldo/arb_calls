<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCategories extends Model
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

    protected $table = 'expense_categories';
}
