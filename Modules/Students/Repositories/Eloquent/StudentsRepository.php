<?php

namespace Modules\Students\Repositories\Eloquent;

use Modules\Students\Contracts\StudentsRepositoryContract;
use Rinvex\Repository\Repositories\EloquentRepository;
use Illuminate\Contracts\Container\Container;


class StudentsRepository extends EloquentRepository implements StudentsRepositoryContract
{

    // Instantiate repository object with required data
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(\Modules\Students\Entities\Eloquent\Student::class)
            ->setRepositoryId('rinvex.repository.uniqueid');

    }

}