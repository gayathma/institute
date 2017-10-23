<?php

namespace Modules\Subjects\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Subjects\Contracts\SubjectsRepositoryContract as SubjectsRepository;
use View;

class SubjectsController extends Controller
{

    private $subjectRepository;

    public function __construct(SubjectsRepository $subjectRepository)
    {
        $this->middleware('auth');
        $this->subjectRepository = $subjectRepository;
    }

    /**
     * Display a listing of the subjects.
     * @return Response
     */
    public function index()
    {
        return View::make('subjects::index', [
                'results' => $this->subjectRepository->paginate(15)
            ])->render();
    }

    /**
     * Show the form for creating a new subject.
     * @return Response
     */
    public function create()
    {
        return View::make('subjects::edit');
    }

    /**
     * Store a newly created subject in storage.
     * @param  CreateSubjectRequest $request
     * @return Response
     */
    public function store(CreateSubjectRequest $request)
    {
        $this->subjectRepository->create($request->all());

        return 'Subject Successfully Created !!';
    }

    /**
     * Show the specified subject.
     * @return Response
     */
    public function show()
    {
        return view('subjects::show');
    }

    /**
     * Show the form for editing the specified subject.
     * @param  Request $request
     * @return Response
     */
    public function edit(Request $request)
    {
        return view('subjects::edit',[
            'result' => $this->subjectRepository->find($request::get('id'))
        ]);
    }

    /**
     * Update the specified resource in subject.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateSubjectRequest $request)
    {
        $this->subjectRepository->find($request->get('id'))->update($request->all());

        return 'Subject Successfully Saved !!';
    }

    /**
     * Remove the specified resource from subject.
     * @param  Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        $this->subjectRepository->delete($request::get('id'));
        return 'Subject Has Been Deleted Successfully !!';
    }
}
