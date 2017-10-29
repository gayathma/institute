<?php

namespace Modules\Classes\Entities\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'class';

    protected $fillable = ['name', 'code'];

}
