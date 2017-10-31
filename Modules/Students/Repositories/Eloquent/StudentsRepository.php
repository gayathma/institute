<?php

namespace Modules\Students\Repositories\Eloquent;

use Modules\Students\Contracts\StudentsRepositoryContract;
use Rinvex\Repository\Repositories\EloquentRepository;
use Illuminate\Contracts\Container\Container;
use Modules\Students\Entities\Eloquent\Student;


class StudentsRepository extends EloquentRepository implements StudentsRepositoryContract
{
    protected $skipPresenter = true;

    protected $fillable = ['registration_no', 'first_name', 'last_name', 'address', 'gender', 'phone', 'class_id'];

    // Instantiate repository object with required data
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(Student::class)
            ->setRepositoryId('rinvex.repository.uniqueid');

    }

}