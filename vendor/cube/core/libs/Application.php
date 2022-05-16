<?php

namespace cube\libs;


class Application
{
    public static function getSubName($id) {
        $get = \R::findOne('subs', 'id = ?', [$id]);
        return $get;
    }
    public static function getUser($id) {
        $get = \R::findOne('users', 'id = ?', [$id]);
        return $get;
    }
    public static function getVsp($id) {
        $get = \R::findOne('vsp', 'id = ?', [$id]);
        return $get;
    }
    public static function getTypeEquip($id) {
        return \R::findOne('equipment_type', 'id = ?', [$id]);
    }
    public static function getPRF($array)
    {
        $str = '';
        $perf = implode(',', $array);
        $perf = \R::find('equipment_type', "id IN({$perf})");
        foreach ($perf as $p) {
            $str .= $p->title . ',';
        }
        $str = rtrim($str, ',');
        return $str;
    }
}