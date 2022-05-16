<?php

	namespace app\controllers;


	use app\models\Extradition;
	use cube\base\Model;
	use cube\libs\Application;

	class ExtraditionController extends AppController
	{
		public function indexAction()
		{
			$items = \R::find('users');
			$vsp = \R::find('vsp');
			$this->setMeta('Выдача/Изъятие');
			$this->set(compact('items', 'vsp'));
		}

		public function stepOneAction()
		{
			if (!empty($_POST)) {
				$data = $_POST;
				$data = Model::getSerialize($data);
				if (!isset($_SESSION['import'][$data['user_id']][$data['id_sbs']])) {
					$_SESSION['import'][$data['user_id']][$data['id_sbs']] = $data;
				}
				$_SESSION['id_sbs_active'] = $data['user_id'] . ',' . $data['id_sbs'];
			}
			$equipment_type = \R::find('equipment_type', 'parent_id = 0');
			$active = explode(',', $_SESSION['id_sbs_active']);
			$item = $equip = $_SESSION['import'][$active[0]][$active[1]];
			if ($this->isAjax()) {
				$this->loadView('index', compact('equipment_type', 'item'));
			}
		}

		public function getTypeAction()
		{
			if (!empty($_POST)) {
				$data = $_POST;
				$id = $data['id'];
				$periferia = \R::find('equipment_type', 'parent_id = ?', [$id]);
			}
			if ($this->isAjax()) {
				$this->loadView('equip', compact('id', 'periferia'));
			}
		}

		public function addOrderAction()
		{
			$m = new Extradition();
			$str = '';
			if (!empty($_POST)) {
				$data = $_POST;
				$data = Model::getSerialize($data);
				$active = explode(',', $_SESSION['id_sbs_active']);
				$_SESSION['import'][$active[0]][$active[1]]['equip'][] = $data;
				$equip = $_SESSION['import'][$active[0]][$active[1]]['equip'];
				$method = $_SESSION['import'][$active[0]][$active[1]];
			}
			if ($this->isAjax()) {
				//debug($equip);
				//die;
				$this->loadView('equipList', compact('equip', 'method'));
			}
		}

		public function delRowAction()
		{
			if (!empty($_POST)) {
				$data = $_POST;
				$active = explode(',', $_SESSION['id_sbs_active']);
				unset($_SESSION['import'][$active[0]][$active[1]]['equip'][$data['dataId']]);
				$equip = $_SESSION['import'][$active[0]][$active[1]]['equip'];
			}
			if ($this->isAjax()) {
				$this->loadView('equipList', compact('equip'));
			}
		}

		public function saveOrderAction()
		{
			$str = '';
			if (isset($_SESSION['import'])) {
				$m = new Extradition();
				$active = explode(',', $_SESSION['id_sbs_active']);
				$data = $_SESSION['import'][$active[0]][$active[1]];
				$items = $_SESSION['import'][$active[0]][$active[1]]['equip'];
				$m->attributes['users_id'] = $data['user_id'];
				$m->attributes['id_sbs'] = $data['id_sbs'];
				$m->attributes['client_name'] = $data['client_name'];
				$m->attributes['vsp'] = $data['vsp'];
				$m->attributes['actions'] = $data['actions'];
				if (isset($_POST['comment'])) {
					$m->attributes['comment'] = $_POST['comment'];
				}
				if ($id = $m->save('export')) {
					foreach ($items as $i) {
						if (!empty($i['perf'])) {
							$prf = Application::getPRF($i['perf']);
							$i['equipment_name'] = $prf;
						}
						\R::exec("INSERT INTO expo_equip (
                                      equip_type_id,
                                      serial_num,
                                      inv_num,
                                      equip_name,
                                      actions,
                                      expo	      
                                  ) VALUE (
                                      {$i['type']},
                                      '{$i['serial_num']}',
                                      '{$i['inv_num']}',
                                      '{$i['equipment_name']}',
                                      '{$i['action']}',
                                      {$id}
                                  )");
					}

					$_SESSION['success'] = 'Выдача сохранена!';

					unset($_SESSION['import'][$active[0]][$active[1]]);

					$count = count($_SESSION['import']);

					if (empty($count == 0)) {
						unset($_SESSION['import']);
					}

				}
			}
			if ($this->isAjax()) {
				die;
			}
		}
	}
