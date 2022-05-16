<?php

namespace app\controllers;
use app\models\User;
use cube\base\Model;

class UserController extends AppController
{
		public function indexAction()
		{
			$items = \R::find('users');
			$this->setMeta('Инженера');
			$this->set(compact('items'));
		}

		public function addAction()
		{
			$m = new User();
			if (!empty($_POST)) {
				$data = $_POST;
				if ($this->isAjax()) {
					$data = Model::getSerialize($data);
				}
				$m->attributes = $m->getAttributes('users', ['id']);
				$m->load($data);
				$exist = \R::count('users', 'email = ?', [$m->attributes['email']]);
				if ($exist) {
					$res['error'] = 'Такой инженер уже есть!';
				} else {
					if ($id = $m->save('users')) {
						$user = \R::load('users', $id);
						$res['success'] = 'Инженер ' . $user->title . ' успешно добавлен!';
					}
				}
			}
			if ($this->isAjax()) {
				echo json_encode($res);
				exit;
			}

			$subs = \R::find('subs');
			$this->setMeta('Добавить инженера');
			$this->set(compact('subs'));
		}

		public function viewAction()
		{
			$id = $this->getRequestID();
			$item = \R::findOne('users', 'id = ?', [$id]);
			$items = \R::find('export', 'users_id = ? ORDER BY id DESC', [$id]);
			$this->setMeta('Выдачи ' . $item->title);
			$this->set(compact('item', 'items'));
		}
		public function detailsAction()
		{
			$id = $this->getRequestID();
			$item = \R::findOne('export', 'id = ?', [$id]);
			$items = \R::find('expo_equip', 'expo = ?', [$id]);
			$this->setMeta('Просмотр выдачи');
			$this->set(compact('item', 'items'));
		}
}
