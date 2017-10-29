<?php

namespace Modules\Subjects\Entities\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'subject';
	
	protected $fillable = ['name', 'code'];

}
