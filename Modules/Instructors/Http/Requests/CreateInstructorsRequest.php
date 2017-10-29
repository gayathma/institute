<?php

namespace Modules\Instructors\Http\Requests;

use App\Http\Requests\Request;

class CreateInstructorsRequest extends Request
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
            'code' => 'required|unique:instructor,code',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'marital_status' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ];
    }
}

