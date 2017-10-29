<?php

namespace Modules\Instructors\Repositories\Eloquent;

use Modules\Instructors\Contracts\InstructorsRepositoryContract;
use Rinvex\Repository\Repositories\EloquentRepository;
use Illuminate\Contracts\Container\Container;


class InstructorsRepository extends EloquentRepository implements InstructorsRepositoryContract
{

    // Instantiate repository object with required data
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(\Modules\Instructors\Entities\Eloquent\Instructor::class)
            ->setRepositoryId('rinvex.repository.uniqueid');

    }

}