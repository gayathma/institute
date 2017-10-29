<?php

namespace Modules\Classes\Http\Requests;

use App\Http\Requests\Request;

class CreateClassesRequest extends Request
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
            'code' => 'required|unique:class,code',
            'name' => 'required'
        ];
    }
}

