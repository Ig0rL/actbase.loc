<p class="text-right">
	Приложение №12А <br>
	к Генеральному соглашению № 1457015 <br>
	от "31" марта 2017г.
</p>
<p class="text-center">
	<strong>Акт приема-передачи оборудования</strong>
</p>
<p>
	<strong>Акт №</strong><?=$item->id_sbs?>
</p>
<p>
	<span class=""><?=$vsp->address?>, </span>
	<span class="text-center"><?= getDateTranslite("j F Y" . " г. " . "", strtotime($item->date_save)) ?></span>
</p>
<p>
	Настоящим актом подтверждается, что <strong><?=$ing->title?></strong> сдал, а <strong><?=$item->client_name?></strong> принял(а) следующее оборудование, принадлежащее Заказчику, в объеме, указанном в настоящем Акте, с целью обеспечения его функционирования:
</p>
<!-- /.text-center -->
<table class="table" cellpadding="8" cellspacing="0">
	<thead>
		<th>№ п/п</th>
		<th>Серийный номер/Инвентарный номер</th>
		<th>Наименование</th>
		<th>Конфигурация</th>
		<th>Кол-во, ед:</th>
	</thead>
	<tbody>
	<?php $count = 1; ?>
	<?php $str = ''; ?>
	<?php foreach ($items as $i): ?>
		<tr>
			<td><?=$count?></td>
			<td>
				<?php if($i->serial_num == '' && $i->inv_num == ''): ?>
				Отсутствует
				<?php else: ?>
                <?=$i->serial_num?> / <?=$i->inv_num?>
				<?php endif; ?>
			</td>
			<?php $type = \cube\libs\Application::getTypeEquip($i->equip_type_id); ?>
			<td><?=$type->title?>: <?=$i->equip_name?></td>
			<td>--------------</td>
			<?php $eType = count(explode(',', $i->equip_name)); ?>
			<td><?=$eType?></td>
		</tr>
	<?php $str .= $type->title . ': ' . $i->equip_name . ', '; ?>
	<?php $count++; ?>
	<?php endforeach; ?>
	</tbody>
</table><br>
<p class="m-0">
	Оборудование передано в следуюшей комплектации: <strong><?=rtrim($str, ', ');?></strong> и в следующем состоянии: <strong>рабочее</strong>
</p>
<p class="m-0">
	Оборудование является собственностью Заказчика и размещается в помещении Исполнителя на время действия Соглашения, указанного ниже.
</p>
<p class="m-0">
	Датой начала оказания Услуг по Генеральному соглашению на оказание ИТ-услуг по технической поддержке №____________ от "___"______________201__г. в отношении оборудования, указанного в настоящем акте, является "___"___________201__г.
</p><br><br>
<div class="f-left w-50">
	<p class="m-0"><strong>От Исполнителя:</strong></p>
	<p class="m-0"><strong>Инженер: </strong><?=$ing->title?></p><br>
	<p class=""><strong>Подпись:</strong>______________</p>
</div><!-- /.f-left w-50 -->
<div class="f-left w-50">
	<p class="m-0"><strong>От Заказчика:</strong></p>
	<p class="m-0"><?=$item->client_name?></p><br>
	<p class=""><strong>Подпись:</strong>______________</p>
</div><!-- /.f-left w-50 -->