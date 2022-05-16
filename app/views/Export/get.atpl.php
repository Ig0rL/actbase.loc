<script>
    $('#dtMaterialDesignExample').DataTable({
        order: [[ 2, "desc" ]],
        language: {
            "sProcessing":   "Подождите...",
            "sLengthMenu":   "Показать _MENU_ записей",
            "sZeroRecords":  "Записи отсутствуют.",
            "sInfo":         "Записи с _START_ до _END_ из _TOTAL_ записей",
            "sInfoEmpty":    "Записи с 0 до 0 из 0 записей",
            "sInfoFiltered": "(отфильтровано из _MAX_ записей)",
            "sInfoPostFix":  "",
            "sSearch":       "Поиск:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst": "Первая",
                "sPrevious": "Предыдущая",
                "sNext": "Следующая",
                "sLast": "Последняя"
            },
            "oAria": {
                "sSortAscending":  ": активировать для сортировки столбца по возрастанию",
                "sSortDescending": ": активировать для сортировки столбцов по убыванию"
            }
        }
    });
    $('#dtMaterialDesignExample_wrapper').find('label').each(function () {
        $(this).parent().append($(this).children());
    });
    $('#dtMaterialDesignExample_wrapper .dataTables_filter').addClass('mt-3').find('input').each(function () {
        const $this = $(this);
        $this.attr("placeholder", "Поиск");
        $this.removeClass('form-control-sm');
    });
    $('#dtMaterialDesignExample_wrapper .dataTables_length').addClass('d-flex flex-row');
    $('#dtMaterialDesignExample_wrapper .dataTables_filter').addClass('md-form');
    $('#dtMaterialDesignExample_wrapper select').removeClass(
        'custom-select custom-select-sm form-control form-control-sm');
    $('#dtMaterialDesignExample_wrapper select').addClass('mdb-select');
    $('#dtMaterialDesignExample_wrapper .mdb-select').materialSelect();
    $('#dtMaterialDesignExample_wrapper .dataTables_filter').find('label').remove();
</script>
<div class="col-lg-12">
	<table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
		<thead>
		<tr>
			<th class="th-sm">ID СБС
			</th>
			<th class="th-sm">Инженер
			</th>
			<th class="th-sm">Клиент
			</th>
			<th class="th-sm">Комментарий
			</th>
			<th class="th-sm">Дата
			</th>
			<th class="th-sm">
			</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($items as $i): ?>
			<tr>
				<td><strong><?=$i->id_sbs?></strong></td>
				<td>
					<?php $user = \cube\libs\Application::getUser($i->users_id); ?>
					<?=$user->title;?>
				</td>
				<td><?=$i->client_name?></td>
				<td><?=$i->comment?></td>
				<td>
					<?= getDateTranslite("j F Y" . " г. " . ", G:i:s", strtotime($i->date_save)) ?>
				</td>
				<td>
					<?=$i->actions == '0' ? '<span class="badge badge-pill badge-primary">Выдача</span>' : ''?>
					<?=$i->actions == '1' ? '<span class="badge badge-pill badge-danger">Изъятие</span>' : ''?>
					<?=$i->actions == '2' ? '<span class="badge badge-pill badge-dark">Замена</span>' : ''?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
		<tfoot>
		<tr>
			<th>ID СБС
			</th>
			<th>Инженер
			</th>
			<th>Клиент
			</th>
			<th>Комментарий
			</th>
			<th>Дата
			</th>
			<th>
			</th>
		</tr>
		</tfoot>
	</table>
</div>
<!-- /.col-lg-12 -->
