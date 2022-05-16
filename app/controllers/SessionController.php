<?php

namespace app\controllers;


class SessionController extends AppController
{
    public function indexAction()
    {
        if(empty($_SESSION['import'])) {
            unset($_SESSION['import']);
            redirect('/extradition');
        }
        $items = [];
        $import = $_SESSION['import'];
        foreach ($import as $k => $v) {
            foreach ($v as $id_sbs => $array) {
                $items[$id_sbs] = $array;
            }
        }
        $this->setMeta('Открытые сессии');
        $this->set(compact('items'));
    }
    public function delRowSessionAction()
    {
        if(!empty($_POST)) {
            $data = $_POST;
            unset($_SESSION['import'][$data['dataUser']][$data['dataId']]);
        }
        if(empty($_SESSION['import'][$data['dataUser']])) {
            unset($_SESSION['import'][$data['dataUser']]);
        }
        $items = [];
        $import = $_SESSION['import'];
        $count = count($_SESSION['import']);
        foreach ($import as $k => $v) {
            foreach ($v as $id_sbs => $array) {
                $items[$id_sbs] = $array;
            }
        }
        if($this->isAjax()) {
            $this->loadView('index', compact('items', 'count'));
        }
    }
    public function editAction()
    {
        $g = $_GET;
        $item = $_SESSION['import'][$g['user']][$g['id_sbs']];
        $equipment_type = \R::find('equipment_type', 'parent_id = 0');
        $equip = $_SESSION['import'][$g['user']][$g['id_sbs']]['equip'];
        $method = $_SESSION['import'][$g['user']][$g['id_sbs']];
        $this->setMeta('Редактирование сессии');
        $this->set(compact('equipment_type', 'item', 'equip', 'method'));
    }
}