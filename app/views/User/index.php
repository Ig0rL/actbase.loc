<div class="card z-depth-5">
    <div class="card-header bg-white d-flex align-items-center">
        <h5 class="mb-0 mr-3">Инженера</h5>
        <a title="Добавить инженера"
           data-toggle="tooltip"
           href="user/add"
           data-placement="right"
           class=" material-tooltip-main z-depth-1 m-0 btn-floating btn-sm btn-amber"><i class="fas fa-plus fz-24"></i></a>
    </div>
    <div class="card-body">
        <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
            <thead>
            <tr>
				<th class="th-sm">Таб. №
				</th>
                <th class="th-sm">ФИО
                </th>
                <th class="th-sm">Подразделение
                </th>
                <th class="th-sm">Почта SIGMA
                </th>
                <th class="th-sm">Моб. номер
                </th>
				<th></th>
            </tr>
            </thead>
            <tbody>
			<?php foreach ($items as $i): ?>
			<tr>
				<td><?=$i->tabel?></td>
				<td>
					<?=$i->title?>
				</td>
				<td><?php $s = \cube\libs\Application::getSubName($i->sub_id); ?>
                    <?=$s->title?>
					<br><?=$i->location?></td>
				<td><?=$i->email?></td>
				<td><?=$i->phone?></td>
				<td>
					<!--<a href="#"
					   data-toggle="tooltip"
					   data-placement="top"
					   target="_blank"
					   title="Печать"
					   class="material-tooltip-main btn-floating btn-sm btn-primary">
						<i class="fas fz-24 fa-print"></i>
					</a>-->
					<a href="user/view?id=<?=$i->id?>"
					   data-toggle="tooltip"
					   data-placement="top"
					   title="Открыть"
					   class="material-tooltip-main btn-floating btn-sm btn-primary">
						<i class="fas fz-24 fa-binoculars"></i>
					</a>
				</td>
			</tr>
			<?php endforeach; ?>
			</tbody>
            <tfoot>
            <tr>
				<th>Таб. №
				</th>
				<th>ФОИ
				</th>
				<th>Подразделение
				</th>
				<th>Почта SIGMA
				</th>
				<th>Моб. номер
				</th>
				<th width="100"></th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>