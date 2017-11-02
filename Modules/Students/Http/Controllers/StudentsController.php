<?php

namespace Modules\Students\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Students\Http\Requests\CreateStudentRequest;
use Modules\Students\Http\Requests\UpdateStudentRequest;
use Modules\Students\Contracts\StudentsRepositoryContract as StudentsRepository;
use Modules\Classes\Entities\Eloquent\Classes;
use View;

class StudentsController extends Controller
{

    private $studentRepository;

    public function __construct(StudentsRepository $studentRepository)
    {
        $this->middleware('auth');
        $this->studentRepository = $studentRepository;
    }

    /**
     * Display a listing of the students.
     * @return Response
     */
    public function index()
    {
        return View::make('students::index', [
            'results' => $this->studentRepository->paginate(15)
        ])->render();
    }

    /**
     * Show the form for creating a new student.
     * @return Response
     */
    public function create()
    {
        return View::make('students::edit', [
            'classes' => Classes::all(),
            'result' => null
        ]);
    }

    /**
     * Store a newly created student in storage.
     * @param  CreateStudentRequest $request
     * @return Response
     */
    public function store(CreateStudentRequest $request)
    {
        $this->studentRepository->create($request->all());

        return 'Student Successfully Created !!';
    }

    /**
     * Show the specified student.
     * @return Response
     */
    public function show()
    {
        return view('students::show');
    }

    /**
     * Show the form for editing the specified student.
     * @param  Request $request
     * @return Response
     */
    public function edit(Request $request)
    {
        return view('students::edit',[
            'classes' => Classes::all(),
            'result' => $this->studentRepository->find($request->get('id'))
        ]);
    }

    /**
     * Update the specified resource in student.
     * @param  UpdateStudentRequest $request
     * @return Response
     */
    public function update(UpdateStudentRequest $request)
    {
        $this->studentRepository->find($request->get('id'))->update($request->all());

        return 'Student Successfully Saved !!';
    }

    /**
     * Remove the specified resource from student.
     * @param  Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        $this->studentRepository->delete($request->get('id'));
        return 'Student Has Been Deleted Successfully !!';
    }
}
