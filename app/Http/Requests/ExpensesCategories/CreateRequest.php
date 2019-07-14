<?php

namespace App\Http\Requests\ExpensesCategories;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Request;

class CreateRequest extends Request
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
            'name'          => 'required|unique:expense_categories,name',
            'description'   => 'required'
        ];
    }

    public function messages(){
        return [
            'name.required'         => __('system.required_fields.name'),
            'description.required'  => __('system.required_fields.description')
        ];
    }
}
