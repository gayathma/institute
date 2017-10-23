<?php
namespace App\Repositories;
use Rinvex\Repository\Repositories\BaseRepository As Repository;

abstract class  BaseRepository extends Repository{

    public function findById($id){
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->find($id);
        $this->resetModel();
        return $this->parserResult($model);

    }
}