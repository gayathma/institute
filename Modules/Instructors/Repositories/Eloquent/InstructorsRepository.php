<?php

namespace Modules\Instructors\Repositories\Eloquent;

use Modules\Instructors\Contracts\InstructorsRepositoryContract;
use Rinvex\Repository\Repositories\EloquentRepository;
use Illuminate\Contracts\Container\Container;
use Modules\Instructors\Entities\Eloquent\Instructor;
use DB;


class InstructorsRepository extends EloquentRepository implements InstructorsRepositoryContract
{

	protected $skipPresenter = true;

    private $fillable = ['code', 'first_name', 'last_name', 'marital_status', 'gender', 'address', 'phone'];


    // Instantiate repository object with required data
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(Instructor::class)
            ->setRepositoryId('rinvex.repository.uniqueid');

    }

    public function create(array $attributes = array())
    {
        DB::beginTransaction();

        try{

        	$instructor = Instructor::create(array_only($attributes, $this->fillable));

        	if(count($attributes['subjects']) > 0){
        		foreach ($attributes['subjects'] as $subject_id) {
        			$instructor->subjects()->attach($subject_id);
        		}

            }
        	DB::commit();
        }catch(\Exception $e){
        	DB::rollback();
        }
    }

    public function update($id, array $attributes = array())
    {
         DB::beginTransaction();

         try{

            $instructor = Instructor::find($id);
            $instructor->subjects()->detach();

            if(count($attributes['subjects']) > 0){
        		foreach ($attributes['subjects'] as $subject_id) {
        			$instructor->subjects()->attach($subject_id);
        		}

            }

            $instructor = parent::update($id, array_only($attributes, $this->fillable));

    		DB::commit();
            return true;
         }catch(\Exception $e){
             DB::rollback();
         }
    }

}