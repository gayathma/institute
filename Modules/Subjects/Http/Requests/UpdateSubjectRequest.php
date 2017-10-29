<?php

namespace Modules\Subjects\Http\Requests;

use App\Http\Requests\Request;
use Modules\Subjects\Contracts\SubjectsRepositoryContract as SubjectsRepository;
use Request as HttpRequest;

class UpdateSubjectRequest extends Request
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
    public function rules(SubjectsRepository $subjectRepository)
    {
        $rules = new CreateSubjectRequest();

        

        return array_merge($rules->rules(), [
                'code' => 'required|unique:subject,code,' . $subjectRepository->find(HttpRequest::get('id'))->id 

            ]);

    }
}
