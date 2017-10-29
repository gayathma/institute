<?php

namespace Modules\Instructors\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Instructors\Http\Requests\CreateInstructorsRequest;
use Modules\Instructors\Http\Requests\UpdateInstructorsRequest;
use Modules\Instructors\Contracts\InstructorsRepositoryContract as InstructorsRepository;
use Modules\Subjects\Entities\Eloquent\Subject;
use Modules\Instructors\Entities\Eloquent\Instructor;
use View;

class InstructorsController extends Controller
{

    private $instructorsRepository;

    public function __construct(InstructorsRepository $instructorsRepository)
    {
        $this->middleware('auth');
        $this->instructorsRepository = $instructorsRepository;
    }

    /**
     * Display a listing of the instructors.
     * @return Response
     */
    public function index()
    {
        return View::make('instructors::index', [
            'results' => $this->instructorsRepository->paginate(10)
        ])->render();
    }

    /**
     * Show the form for creating a new instructor.
     * @return Response
     */
    public function create()
    {
        return View::make('instructors::edit', [
            'subjects' => Subject::all(),
            'instructor_subjects' => array(),
            'result' => null
        ]);
    }

    /**
     * Store a newly created instructor in storage.
     * @param  CreateInstructorsRequest $request
     * @return Response
     */
    public function store(CreateInstructorsRequest $request)
    {
        $this->instructorsRepository->create($request->all());

        return 'Instructor Successfully Created !!';
    }

    /**
     * Show the specified instructor.
     * @return Response
     */
    public function show()
    {
        return view('instructors::show');
    }

    /**
     * Show the form for editing the specified instructor.
     * @param  Request $request
     * @return Response
     */
    public function edit(Request $request)
    {
        return view('instructors::edit',[
            'subjects' => Subject::all(),
            'instructor_subjects' => Instructor::find($request->get('id'))->subjects()->pluck('subject_id')->toArray(),
            'result' => $this->instructorsRepository->find($request->get('id'))
        ]);
    }

    /**
     * Update the specified resource in instructor.
     * @param  UpdateInstructorsRequest $request
     * @return Response
     */
    public function update(UpdateInstructorsRequest $request)
    {
        $this->instructorsRepository->update($request->get('id'), $request->all());

        return 'Instructor Successfully Saved !!';
    }

    /**
     * Remove the specified resource from instructor.
     * @param  Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        $this->instructorsRepository->delete($request::get('id'));
        return 'Instructor Has Been Deleted Successfully !!';
    }
}
