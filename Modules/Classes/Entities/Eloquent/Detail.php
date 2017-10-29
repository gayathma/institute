<?php

namespace Modules\Classes\Entities\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'class_detail';

    protected $fillable = ['class_id', 'subject_id', 'instructor_id'];

}
