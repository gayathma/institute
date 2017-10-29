<?php 

namespace Modules\Dashboard\Lib\EditableTable;

interface TabularContract
{
    const FIELD_STRING = 'string';
    const FIELD_TEXT = 'text';
    const FIELD_DATE = 'date';
    const FIELD_MONTH = 'month';
    const FIELD_SELECT = 'select';
    const FIELD_RADIO = 'radio';
    const FIELD_CHECKBOX = 'checkbox';
    const FIELD_HIDDEN = 'hidden';

    public function rowIncrementer();

    public function buttonClass();

    public function entity();
    
    public function tabularFields();
}