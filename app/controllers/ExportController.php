<?php

namespace app\controllers;

use cube\base\Model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController extends AppController
{
	public function toExlAction()
	{
		$sql = '';
		if(!empty($_POST)) {
			$data = $_POST;
			if ($this->isAjax()) {
				$data = Model::getSerialize($data);
			}
			if(!empty($data['start-date_submit']) && !empty($data['end-date_submit'])) {
				$sql .= " WHERE date_save BETWEEN STR_TO_DATE('{$data['start-date_submit']}', '%Y-%m-%d') AND STR_TO_DATE('{$data['end-date_submit']}', '%Y-%m-%d') ";
				if(!empty($data['user'])) {
					$sql .= " AND users_id = {$data['user']} ";
				}
			}else {
				if(!empty($data['user'])) {
					$sql .= " WHERE users_id = {$data['user']} ";
				}
			}
		}
		$str = '';
		$getExp = \R::getAssoc("SELECT * FROM export {$sql}");
		foreach ($getExp as $k => $v) {
			$str .= $k . ',';
		}
		$str = rtrim($str, ',');
		$getEquip = \R::getAssoc("SELECT * FROM expo_equip WHERE expo IN({$str})");
		$vsp = \R::getAssoc("SELECT * FROM vsp");
		$equipType = \R::getAssoc("SELECT * FROM equipment_type WHERE parent_id = 0");
		$subs = \R::getAssoc("SELECT * FROM subs");
		$user = \R::getAssoc("SELECT * FROM users");

		$array = [];

		foreach ($getEquip as $k => $v) {
			foreach ($getExp as $id => $item) {
				if($v['expo'] == $id) {
					$array[$k] = $item;
				}
			}
			foreach ($vsp as $vk => $vv) {
				if(isset($array[$k]) && $array[$k]['vsp'] == $vk) {
					$array[$k]['vsp'] = $vv;
				}
			}
			foreach ($user as $uk => $uv) {
				if(isset($array[$k]) && $array[$k]['users_id'] == $uk) {
					$array[$k]['user'] = $uv;
				}
			}
			$array[$k]['equip'] = $v;
			foreach ($equipType as $eid => $ev) {
				if(isset($array[$k]['equip']) && $array[$k]['equip']['equip_type_id'] == $eid) {
					$array[$k]['equip']['equip_type_id'] = $ev['title'];
				}
			}
		}
		$date = date('d-m-Y_H-i-s');

		$xls = new Spreadsheet();
		$xls->setActiveSheetIndex(0);
		$aXls = $xls->getActiveSheet();
		$aXls->getPageSetup()->setOrientation(\PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$aXls->getPageSetup()->setPaperSize(\PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

		$aXls->setTitle($date);

		$xls->getDefaultStyle()->getFont()->setName('Arial');
		$xls->getDefaultStyle()->getFont()->setSize(9);

		$aXls->getColumnDimension("A")->setWidth(15);
		$aXls->getColumnDimension("B")->setWidth(40);
		$aXls->getColumnDimension("C")->setWidth(40);
		$aXls->getColumnDimension("D")->setWidth(50);
		$aXls->getColumnDimension("E")->setWidth(10);
		$aXls->getColumnDimension("F")->setWidth(30);
		$aXls->getColumnDimension("G")->setWidth(20);
		$aXls->getColumnDimension("H")->setWidth(20);
		$aXls->getColumnDimension("I")->setWidth(20);
		$aXls->getColumnDimension("J")->setWidth(20);
		$aXls->getColumnDimension("K")->setWidth(10);
		$aXls->getColumnDimension("L")->setWidth(40);

		$aXls->getStyle("A1")->getFont()->setBold(true);
		$aXls->getStyle("B1")->getFont()->setBold(true);
		$aXls->getStyle("C1")->getFont()->setBold(true);
		$aXls->getStyle("D1")->getFont()->setBold(true);
		$aXls->getStyle("E1")->getFont()->setBold(true);
		$aXls->getStyle("F1")->getFont()->setBold(true);
		$aXls->getStyle("G1")->getFont()->setBold(true);
		$aXls->getStyle("H1")->getFont()->setBold(true);
		$aXls->getStyle("I1")->getFont()->setBold(true);
		$aXls->getStyle("J1")->getFont()->setBold(true);
		$aXls->getStyle("K1")->getFont()->setBold(true);
		$aXls->getStyle("L1")->getFont()->setBold(true);

		$aXls->setCellValue('A1', 'ID СБС');
		$aXls->setCellValue('B1', 'Инженер');
		$aXls->setCellValue('C1', 'Внутренний клиент');
		$aXls->setCellValue('D1', 'Адрес');
		$aXls->setCellValue('E1', 'Дата');
		$aXls->setCellValue('F1', 'Действие по заявке');
		$aXls->setCellValue('G1', 'Тип оборудования');
		$aXls->setCellValue('H1', 'Серийный номер');
		$aXls->setCellValue('I1', 'Инвентариный номер');
		$aXls->setCellValue('J1', 'Наименование оборудования');
		$aXls->setCellValue('K1', 'Действие над оборудование');
		$aXls->setCellValue('L1', 'Комментарий');

		$start = 2;
		$count = 0;

		foreach ($array as $a) {
			$next = $start + $count;
			$action = '';
			$e_a = '';
			if($a['actions'] == '0') $action = 'Выдача';
			if($a['actions'] == '1') $action = 'Изъятие';
			if($a['actions'] == '2') $action = 'Замена';

			if($a['equip']['actions'] == '0') $e_a = 'Изъятие';
			if($a['equip']['actions'] == '1') $e_a = 'Выдача';

			$aXls->setCellValue('A'.$next, $a['id_sbs']);
			$aXls->setCellValue('B'.$next, $a['user']['title']);
			$aXls->setCellValue('C'.$next, $a['client_name']);
			$aXls->setCellValue('D'.$next, $a['vsp']['num'] . '/' . $a['vsp']['address']);
			$aXls->setCellValue('E'.$next, $a['date_save']);
			$aXls->setCellValue('F'.$next, $action);
			$aXls->setCellValue('G'.$next, $a['equip']['equip_type_id']);
			$aXls->setCellValue('H'.$next, $a['equip']['serial_num']);
			$aXls->setCellValue('I'.$next, $a['equip']['inv_num']);
			$aXls->setCellValue('J'.$next, $a['equip']['equip_name']);
			$aXls->setCellValue('K'.$next, $e_a);
			$aXls->setCellValue('L'.$next, $a['comment']);
			$count++;
		}
		$writer = new Xlsx($xls);
		$file = WWW . '/' . $date . '.xlsx';
		$download = $date . '.xlsx';
		$writer->save($file);

		if($this->isAjax()) {
			$this->loadView('xlsx', compact('download'));
		}
		exit();
	}
    public function indexAction()
    {
		$users = \R::find('users');
		$type = \R::find('equipment_type', 'parent_id = 0');
		$this->setMeta('Выгрузка');
		$this->set(compact('users', 'type'));
    }
    public function getAction()
    {
    	     $sql = "";
    	     if(!empty($_POST)) {
    	     	$data = $_POST;
	          if ($this->isAjax()) {
		          $data = Model::getSerialize($data);
	          }
	          if(!empty($data['start-date_submit']) && !empty($data['end-date_submit'])) {
	          	$sql .= " WHERE date_save BETWEEN STR_TO_DATE('{$data['start-date_submit']}', '%Y-%m-%d') AND STR_TO_DATE('{$data['end-date_submit']}', '%Y-%m-%d') ";
		          if(!empty($data['user'])) {
			          $sql .= " AND users_id = {$data['user']} ";
		          }
	          }else {
		          if(!empty($data['user'])) {
			          $sql .= " WHERE users_id = {$data['user']} ";
		          }
	          }
          }
          $items = \R::getAll("SELECT * FROM export {$sql}");
          $items = json_encode($items);
          $items = json_decode($items);
          if($this->isAjax()) {
    	     	$this->loadView('get', compact('items'));
          }
    }
}
