<div class="card z-depth-5">
	<div class="card-header bg-white d-flex align-items-center">
		<h5 class="mb-0 mr-3">ID №<?=$item->id_sbs?></h5>
	</div>
	<div class="card-body mselect">
			<div class="row">
				<div class="col-lg-6 col-sm-12">
					<div class="card mb-3">
						<div class="card-body">
							<p class="mb-0 fz-14">
								<?php $ing = \cube\libs\Application::getUser($item->users_id); ?>
								<span class="font-weight-bold">Инженер: </span>
								<!-- /.font-weight-bold --> <?=$ing->title?>
							</p>
							<p class="mb-0 fz-14"><span class="font-weight-bold">ID запроса: </span><?=$item->id_sbs?></p>
							<p class="mb-0 fz-14"><span class="font-weight-bold">Клиент: </span><?=$item->client_name?></p>
							<p class="mb-0 fz-14">
								<?php $vsp = \cube\libs\Application::getVsp($item->vsp); ?>
								<span class="font-weight-bold">ВСП/ГОСБ: </span>
								<?=$vsp->num . ' ' .$vsp->address;?>
							</p>
						</div>
					</div>
				</div>
			</div>

            <div class="row">
                <div class="col-sm-12">
                    <h5 class="card-title mt-4">Оборудование</h5>
                    <hr>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Тип оборудования</th>
                            <th scope="col">Серийный №</th>
                            <th scope="col">Инвентарный №</th>
                            <th scope="col">Название</th>
                        </tr>
                        </thead>
                        <tbody>
				    <?php foreach ($items as $i): ?>
                            <tr>
                                <th scope="row">
							  <?php $type = \cube\libs\Application::getTypeEquip($i->equip_type_id); ?>
							  <?=$type->title;?>
                                </th>
						   <?php if(empty($i->serial_num) && empty($i->inv_num)): ?>
                                     <td>Отсутствует</td>
                                     <td>Отсутствует</td>
                                     <td>
								  <?=$i->equip_name?>
                                     </td>
						   <?php else: ?>
                                     <td><?=$i->serial_num?></td>
                                     <td><?=$i->inv_num?></td>
                                     <td><?=$i->equip_name?></td>
						   <?php endif; ?>

                                <td>
							  <?php if($i->actions == '1'): ?>
                                         <span class="badge badge-pill badge-primary">Выдача</span>
							  <?php else: ?>
                                         <span class="badge badge-pill badge-danger">Изъятие</span>
							  <?php endif; ?>
                                </td>
                            </tr>
				    <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php if(!empty($item->comment)): ?>
                    <p class="font-weight-bold">
                        Комментарий
                    </p>
                        <p>
	                        <?=$item->comment?>
                        </p>
                    <?php endif; ?>
                    <a href="print/view?id=<?=$item->id?>"
                       data-toggle="tooltip"
                       data-placement="top"
                       target="_blank"
                       title="Печать"
                       class="material-tooltip-main btn btn-md btn-sm btn-secondary">
                        <i class="fas fz-24 fa-print"></i>
                    </a>
                </div>
            </div>

	</div>
</div>
