<?php

namespace Modules\Classes\Repositories\Eloquent;

use Modules\Classes\Contracts\ClassesRepositoryContract;
use Rinvex\Repository\Repositories\EloquentRepository;
use Illuminate\Contracts\Container\Container;
use Modules\Classes\Entities\Eloquent\Classes;
use Modules\Classes\Tables\DetailTable;
use DB;


class ClassesRepository extends EloquentRepository implements ClassesRepositoryContract
{

	protected $skipPresenter = true;

    private $fillable = ['name', 'code'];

    // Instantiate repository object with required data
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(Classes::class)
            ->setRepositoryId('rinvex.repository.uniqueid');

    }

    public function create(array $attributes = array())
    {
        DB::beginTransaction();

        try{

        	$class = Classes::create(array_only($attributes, $this->fillable));

        	/**
             * Remove Last hidden detail row
             **/
            $details = $attributes['details'];

            $table = DetailTable::create($class, 'details', 'table');
            $table->saveData($details);

            $this->saveTabularData($class, $attributes); 


        	DB::commit();
        }catch(\Exception $e){
        	DB::rollback();
        }
    }

    public function update($id, array $attributes = array())
    {
         DB::beginTransaction();

         try{
            $class = Classes::find($id);
            
            $class = parent::update($id, array_only($attributes, $this->fillable));
            list($status, $instance) = $class;

            $details = $attributes['details'];

            $table = DetailTable::create($class, 'details', 'table');
            $table->saveData($details);

            $this->saveTabularData($instance, $attributes);
            DB::commit();
            return true;
         }catch(\Exception $e){
             DB::rollback();
         }
    }

    private function saveTabularData($class, array $attributes)
    {
        
        $table = DetailTable::create($class, 'details', 'table');
        $table->saveData($attributes['details']);

        return true;
    }

}