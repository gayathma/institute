<?php

namespace Modules\Classes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Classes\Http\Requests\CreateClassesRequest;
use Modules\Classes\Http\Requests\UpdateClassesRequest;
use Modules\Classes\Contracts\ClassesRepositoryContract as ClassesRepository;
use View;

class ClassesController extends Controller
{

    private $classRepository;

    public function __construct(ClassesRepository $classRepository)
    {
        $this->middleware('auth');
        $this->classRepository = $classRepository;
    }

    /**
     * Display a listing of the classes.
     * @return Response
     */
    public function index()
    {
        return View::make('classes::index', [
            'results' => $this->classRepository->paginate(10)
        ])->render();
    }

    /**
     * Show the form for creating a new class.
     * @return Response
     */
    public function create()
    {
        return View::make('classes::edit', [
            'result' => null
        ]);
    }

    /**
     * Store a newly created class in storage.
     * @param  CreateClassesRequest $request
     * @return Response
     */
    public function store(CreateClassesRequest $request)
    {
        $this->classRepository->create($request->all());

        return 'Class Successfully Created !!';
    }

    /**
     * Show the specified class.
     * @return Response
     */
    public function show()
    {
        return view('classes::show');
    }

    /**
     * Show the form for editing the specified class.
     * @param  Request $request
     * @return Response
     */
    public function edit(Request $request)
    {
        return view('classes::edit',[
            'result' => $this->classRepository->find($request->get('id'))
        ]);
    }

    /**
     * Update the specified resource in class.
     * @param  UpdateClassesRequest $request
     * @return Response
     */
    public function update(UpdateClassesRequest $request)
    {
        $this->classRepository->find($request->get('id'))->update($request->all());

        return 'Class Successfully Saved !!';
    }

    /**
     * Remove the specified resource from class.
     * @param  Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        $this->classRepository->delete($request::get('id'));
        return 'Class Has Been Deleted Successfully !!';
    }
}
