<?php

namespace Modules\Students\Entities\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'student';

    protected $fillable = ['first_name', 'last_name', 'address', 'birth_date'];

}
