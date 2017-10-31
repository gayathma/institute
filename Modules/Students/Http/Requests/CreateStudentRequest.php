<?php

namespace Modules\Students\Http\Requests;

use App\Http\Requests\Request;

class CreateStudentRequest extends Request
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
            'registration_no' => 'required|unique:student,registration_no',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'phone' => 'required'
        ];
    }
}

