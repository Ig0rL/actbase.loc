<?php if(!empty($equip)): ?>
	<script>
        $('.material-tooltip-main').tooltip({
            template: '<div class="tooltip md-tooltip-email"><div class="tooltip-arrow md-arrow"></div><div class="tooltip-inner md-inner-email"></div></div>'
        });
	</script>
	<div class="row">
		<div class="col-sm-12">
			<h5 class="card-title mt-4">Выбранное оборудование</h5>
			<hr>
			<table class="table">
				<thead>
				<tr>
					<th scope="col">Тип оборудования</th>
					<th scope="col">Серийный №</th>
					<th scope="col">Инвентарный №</th>
					<th scope="col">Название</th>
					<th scope="col"></th>
				</tr>
				</thead>
				<tbody>
                <?php foreach ($equip as $k => $v): ?>
					<tr>
						<th scope="row">
                            <?php $type = \cube\libs\Application::getTypeEquip($v['type']); ?>
                            <?=$type->title;?>
						</th>
                        <?php if(!empty($v['perf'])): ?>
							<td>Отсутствует</td>
							<td>Отсутствует</td>
							<td>
                                <?=\cube\libs\Application::getPRF($v['perf']);?>
							</td>
                        <?php else: ?>
							<td><?=$v['serial_num']?></td>
							<td><?=$v['inv_num']?></td>
							<td><?=$v['equipment_name']?></td>
                        <?php endif; ?>

						<td>
                            <?php if($v['action'] == '1'): ?>
								<span class="badge badge-pill badge-primary">Выдача</span>
                            <?php else: ?>
								<span class="badge badge-pill badge-danger">Изъятие</span>
                            <?php endif; ?>
						</td>
						<td>
							<a class="text-danger p-1 fz-18 material-tooltip-main del-row"
							   data-toggle="tooltip"
							   data-placement="top"
							   data-id="<?=$k?>"
							   data-action="extradition/del-row"
							   data-content="checked-order"
							   title="Удалить из списка"
							><i class="fas fa-times"></i></a>
						</td>
					</tr>
                <?php endforeach; ?>
				</tbody>
			</table>
				<div class="md-form">
					<textarea id="comment" name="comment" class="md-textarea form-control" rows="3"></textarea>
					<label for="comment">Описание неисправности</label>
				</div>
			<button type="button"
					data-action="extradition/save-order"
					class="btn-amber btn btn-md save-all">
				Сохранить/Закрыть
			</button>
		</div>
	</div>
<?php endif; ?>