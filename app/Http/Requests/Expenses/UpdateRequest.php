<?php

namespace App\Http\Requests\Expenses;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Request;

class UpdateRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'expense_category_id'   => 'required',
            'amount'                => 'required|integer',
            'entry_date'            => 'required'
        ];
    }

    public function messages(){
        return [
            'expense_category_id.required'  => __('system.required_fields.expense_category_id'),
            'amount.required'               => __('system.required_fields.amount'),
            'entry_date.required'           => __('system.required_fields.entry_date')
        ];
    }
}