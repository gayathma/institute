<?php

namespace Modules\Students\Entities\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Modules\Classes\Entities\Eloquent\Classes;

class Student extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'student';

    protected $fillable = ['registration_no', 'first_name', 'last_name', 'address', 'gender', 'phone', 'class_id'];

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

}
