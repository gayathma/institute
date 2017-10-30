<?php

namespace Modules\Subjects\Entities\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Modules\Instructors\Entities\Eloquent\Instructor;

class Subject extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'subject';
	
	protected $fillable = ['name', 'code'];

	public function instructors()
    {
        return $this->belongsToMany(Instructor::class);
    }

}
