<?php

namespace app\controllers;


use cube\libs\Application;

class PrintController extends AppController
{
    public function viewAction()
    {
        $id = $this->getRequestID();
        $item = \R::findOne('export', 'id = ?', [$id]);
 	$vsp = \R::findOne('vsp', 'id = ?', [$item->vsp]);
        $items = \R::find('expo_equip', 'expo = ?', [$id]);
        $ing = Application::getUser($item->users_id);
        $this->layout = 'print';
        $this->view = 'view' . $item->actions;
        $this->setMeta();
        $this->set(compact('item', 'items', 'ing', 'vsp'));
    }
}