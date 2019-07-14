<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expenses extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'user_id',
    	'expense_category_id',
    	'amount',
    	'entry_date'
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at',
        'user_id',
    ];

    protected $appends = [
        'category'
    ];

    public function getUserAttribute(){
        return $this->user()->first();
    }

    public function getCategoryAttribute(){
        return $this->category()->first();
    }

    public function user(){
        return $this->belongsTo('App\Http\Models\Users');
    }

    public function category(){
        return $this->belongsTo('App\Http\Models\ExpenseCategories','expense_category_id');
    }
}
