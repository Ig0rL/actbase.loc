<div class="card z-depth-5">
    <div class="card-header bg-white d-flex align-items-center">
        <h5 class="mb-0 mr-3">Открытые сессии выдач</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th class="th-sm">ID СБС
                </th>
                <th class="th-sm">ФИО инженера
                </th>
                <th class="th-sm">ФИО клиента
                </th>
                <th class="th-sm">
                </th>
            </tr>
            </thead>
            <tbody class="ses-element">
            <?php foreach ($items as $i): ?>
                <tr>
                    <td><strong><?=$i['id_sbs']?></strong></td>
                    <td>
                        <?php $user = \cube\libs\Application::getUser($i['user_id']); ?>
                        <?=$user->title?>
                    </td>
                    <td>
                        <?=$i['client_name'];?>
                        <br>
                        <?php $vsp = \cube\libs\Application::getVsp($i['vsp'])?>
                        <?=$vsp->title?>
                    </td>
                    <td>
						<a href="session/del"
						   data-toggle="tooltip"
						   data-placement="top"
						   title="Удалить"
						   data-id="<?=$i['id_sbs']?>"
						   data-user="<?=$i['user_id']?>"
						   data-action="session/del-row-session"
						   data-content="ses-element"
						   class="material-tooltip-main del-row btn-floating btn-sm btn-danger">
							<i class="fas fz-24 fa-trash"></i>
						</a>
                        <a href="session/edit?user=<?=$i['user_id']?>&id_sbs=<?=$i['id_sbs']?>"
						   data-toggle="tooltip"
						   data-placement="top"
						   title="Продолжить сессию"
                           class="material-tooltip-main btn-floating btn-sm btn-primary">
                            <i class="fas fz-24 fa-arrow-right"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <th>ID СБС
                </th>
                <th>ФИО инженера
                </th>
                <th>ФИО клиента
                </th>
                <th>
                </th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>