<?php 


namespace Modules\Dashboard\Lib\EditableTable;

use Modules\Dashboard\Lib\EditableTable\Table;
use Illuminate\Support\Collection;
use View;
use Illuminate\Database\Eloquent\Model;

class TableAbstract
{

    public $model;
    public $field;
    public $type;
    public $editable = true;
    public $addMore = true;
    public $defaults = [];

    /**
     * saves tabular data array to db
     * @param array $data data array
     * @param object $model the model to update to
     * @param string $field the field name of the mode to update to
     * */
    public function saveData($data)
    {
        $ids = [];

        $entity = $this->getEntity();
        $field = camel_case($this->field);

        // remove last hidden row
        unset($data[key(array_slice($data, -1, 1, true))]);

        foreach ($data as $id => $attrb) {
            if (count(array_values(array_filter($attrb)))) { // removed rows that have all values as empty
                if (isset($attrb['id']) && ($object = $entity::find($attrb['id'])) instanceOf $entity) {
                    $object->update($attrb);
                    $ids[] = $object->id;

                } else {
                    $object = $entity::create(array_merge($attrb, $this->defaults));
                    $this->model->$field()->save($object);
                    $ids[] = $object->id;
                }
            }
        }

        if ($this->model instanceof Model && $this->model->$field instanceof Collection) {
            foreach ($this->model->$field as $object) {
                if (!in_array($object->id, $ids)) {
                    $object->delete();
                }
            }
        }
    }    

    public static function create($model, $field, $type)
    {
        $tableClass = get_called_class();
        $tableClass = new $tableClass($model, $field);

        $tableClass->model = $model instanceof Model ? $model : null;
        $tableClass->field = $field;
        $tableClass->type = $type;
        //$tableClass->editable = true;
        //$tableClass->addMore = true;

        return $tableClass;
    }

    /**
     * @return a collection of items
     * */
    public function getItems()
    {
        $field = camel_case($this->field);
        if (!is_null($this->model)) {
            return $this->model->$field;
        }

        return [];
    }

    /**
     * @return the enity connected to the table
     * */
    public function getEntity()
    {
        $class = $this->entity();
        return new $class;
    }

    public function render()
    {
        return View::make('dashboard::tables.table', ['table' => $this])->render();
    }

    /**
     * @return field of the entity the table is connected to
     * */
    public function getFieldName()
    {
        return $this->field;
    }

     /**
     * @return field of the entity type
     * */
    public function getFieldType()
    {
        return $this->type;
    }

    public function getValidationString($field)
    {
        return isset($this->tabularFields()[$field]['validation']) ? json_encode($this->tabularFields()[$field]['validation']) : '{}';
    }

    /**
     * @return aformatted fieldname
     * */
    public function getFormattedFieldName($i, $field)
    {
        return $this->field . '[' . $i . '][' . $field . ']';
    }
}