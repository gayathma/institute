<?php

namespace Modules\Classes\Repositories\Eloquent;

use Modules\Classes\Contracts\ClassesRepositoryContract;
use Rinvex\Repository\Repositories\EloquentRepository;
use Illuminate\Contracts\Container\Container;


class ClassesRepository extends EloquentRepository implements ClassesRepositoryContract
{

    // Instantiate repository object with required data
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(\Modules\Classes\Entities\Eloquent\Classes::class)
            ->setRepositoryId('rinvex.repository.uniqueid');

    }

}