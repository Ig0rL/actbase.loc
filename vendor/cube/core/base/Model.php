<?php

namespace cube\base;

use cube\Db;

abstract class Model
{
    public $attributes = [];
    public $rules = [];
    public $errors = [];

    public function __construct()
    {
        Db::instance();
    }

    public function getAttributes($table, $del_fields = [])
    {
        $db = \DB;
        $column = \R::getAssoc("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_NAME = '{$table}' AND TABLE_SCHEMA = '{$db}'");
        unset($column['USER']);
        unset($column['CURRENT_CONNECTIONS']);
        unset($column['TOTAL_CONNECTIONS']);

        if(!empty($del_fields)) {
            foreach ($del_fields as $key => $val) {
                unset($column[$val]);
            }
        }
        return $column;
    }

    public function load($data)
    {
        foreach ($this->attributes as $name => $value) {
            if (isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }else {
                $this->attributes[$name] = '';
            }

        }
    }

    public function save($table, $valid = true)
    {
        if ($valid) {
            $tbl = \R::dispense($table);
        } else {
            $tbl = \R::xdispense($table);
        }
        foreach ($this->attributes as $name => $value) {
            $tbl->$name = $value;
        }
        return \R::store($tbl);
    }

    public function update($table, $id)
    {
        $bean = \R::load($table, $id);
        foreach ($this->attributes as $name => $value) {
            $bean->$name = $value;
        }
        return \R::store($bean);
    }

    public static function getSerialize($data)
    {

        if ($data) {
            $newArray = [];
            $perf = [];
            foreach ($data['fields'] as $k => $v) {

                if ($v['name'] == 'perf') {
                    $perf[] = $v['value'];
                }

                $newArray[$v['name']] = $v['value'];
                $newArray['perf'] = $perf;
            }
            return $newArray;
        }
        return false;
    }
}