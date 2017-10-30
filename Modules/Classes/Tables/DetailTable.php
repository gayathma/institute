<?php

namespace Modules\Classes\Tables;

use Modules\Classes\Entities\Eloquent\Detail;
use Modules\Subjects\Entities\Eloquent\Subject;
use Modules\Instructors\Entities\Eloquent\Instructor;
use Modules\Dashboard\Lib\EditableTable\TabularContract;
use Modules\Dashboard\Lib\EditableTable\TableAbstract;
use DB;

class DetailTable extends TableAbstract implements TabularContract
{
    public function rowIncrementer()
    {
        return [
            'enabled' => false
        ];
    }


    public function buttonClass()
    {
        return 'sector-btns';
    }

    public function entity()
    {
        return Detail::class;
    }

    public function tabularFields()
    {
        return [
            'subject_id' => [
                'main_class' => '',
                'label' => 'Subject',
                'label_class' => '',
                'type' => self::FIELD_SELECT,
                'field_class' => '',
                'validation' =>  'required',
                'options' => Subject::pluck('name', 'id')->all(),
                'classes' => ' subject'
            ],
            'instructor_id' => [
                'main_class' => '',
                'label' => 'Instructor',
                'label_class' => '',
                'field_class' => '',
                'type' => self::FIELD_SELECT,
                'options' => Instructor::select('id', DB::raw("concat(first_name, ' ',last_name) as name"))->pluck('name', 'id')->all(),
                'validation' =>  'required'
            ]
        ];
    }
}