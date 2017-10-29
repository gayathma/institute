<?php

namespace Modules\Classes\Http\Requests;

use App\Http\Requests\Request;
use Modules\Classes\Contracts\ClassesRepositoryContract as ClassesRepository;
use Request as HttpRequest;

class UpdateClassesRequest extends Request
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
    public function rules(ClassesRepository $classRepository)
    {
        $rules = new CreateClassesRequest();

        

        return array_merge($rules->rules(), [
                'code' => 'required|unique:class,code,' . $classRepository->find(HttpRequest::get('id'))->id 

            ]);

    }
}
