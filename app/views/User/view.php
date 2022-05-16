<div class="card z-depth-5">
    <div class="card-header bg-white d-flex align-items-center">
        <h5 class="mb-0 mr-3">Выдачи(<?=$item->title?>)</h5>
    </div>
    <div class="card-body">
        <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th class="th-sm">ID СБС
                </th>
                <th class="th-sm">ФИО клиента
                </th>
                <th class="th-sm">Дата создания
                </th>
				<th></th>
                <th width="120"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $i): ?>
                <tr>
                    <td><span class="font-weight-bold"><?=$i->id_sbs?></span></td>
                    <td>
                        <?=$i->client_name?> <br>
                        <?php $vsp = \cube\libs\Application::getVsp($i->vsp); ?>
                        <span class="font-weight-bold">ВСП/ГОСБ: </span>
                        <?=$vsp->num . ' ' .$vsp->address;?>
                    </td>
                    <td>
                        <?= getDateTranslite("j F Y" . " г. " . ", G:i:s", strtotime($i->date_save)) ?>
                    </td>
					<td>
                        <?=$i->actions == '0' ? '<span class="badge badge-pill badge-primary">Выдача</span>' : ''?>
                        <?=$i->actions == '1' ? '<span class="badge badge-pill badge-danger">Изъятие</span>' : ''?>
                        <?=$i->actions == '2' ? '<span class="badge badge-pill badge-dark">Замена</span>' : ''?>
					</td>
                    <td>
                        <a href="print/view?id=<?=$i->id?>"
                           data-toggle="tooltip"
                           data-placement="top"
                           target="_blank"
                           title="Печать"
                           class="material-tooltip-main btn-floating btn-sm btn-secondary">
                            <i class="fas fz-24 fa-print"></i>
                        </a>
                        <a href="user/details?id=<?=$i->id?>"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="Детально"
                           class="material-tooltip-main btn-floating btn-sm btn-amber">
                            <i class="fas fz-24 fa-binoculars"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <th>ID СБС
                </th>
                <th>ФИО клиента
                </th>
                <th>Дата создания
                </th>
				<th></th>
                <th width="100"></th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>