<?php

namespace Modules\Instructors\Entities\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Modules\Subjects\Entities\Eloquent\Subject;

class Instructor extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'instructor';

    protected $fillable = ['code', 'first_name', 'last_name', 'marital_status', 'gender', 'address', 'phone'];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

}
