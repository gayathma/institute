<?php

namespace Modules\Students\Http\Requests;

use App\Http\Requests\Request;
use Modules\Students\Contracts\StudentsRepositoryContract as StudentsRepository;
use Request as HttpRequest;

class UpdateStudentRequest extends Request
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
    public function rules(StudentsRepository $studentRepository)
    {
        $rules = new CreateStudentRequest();

        

        return array_merge($rules->rules(), [
                'registration_no' => 'required|unique:student,registration_no,' . $studentRepository->find(HttpRequest::get('id'))->id

            ]);

    }
}
