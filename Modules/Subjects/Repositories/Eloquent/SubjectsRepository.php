<?php

namespace Modules\Subjects\Repositories\Eloquent;

use Modules\Subjects\Contracts\SubjectsRepositoryContract;
use Rinvex\Repository\Repositories\EloquentRepository;
use Illuminate\Contracts\Container\Container;


class SubjectsRepository extends EloquentRepository implements SubjectsRepositoryContract
{

    // Instantiate repository object with required data
    public function __construct(Container $container)
    {
        $this->setContainer($container)
             ->setModel(\Modules\Subjects\Entities\Eloquent\Subject::class)
             ->setRepositoryId('rinvex.repository.uniqueid');

    }
    
}