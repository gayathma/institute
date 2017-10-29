<?php

namespace Modules\Instructors\Http\Requests;

use App\Http\Requests\Request;
use Modules\Instructors\Contracts\InstructorsRepositoryContract as InstructorsRepository;
use Request as HttpRequest;

class UpdateInstructorsRequest extends Request
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
    public function rules(InstructorsRepository $instructorsRepository)
    {
        $rules = new CreateInstructorsRequest();

        

        return array_merge($rules->rules(), [
                'code' => 'required|unique:class,code,' . $instructorsRepository->find(HttpRequest::get('id'))->id 

            ]);

    }
}
