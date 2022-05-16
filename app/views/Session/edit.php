<div class="card z-depth-5">
    <div class="card-header bg-white d-flex align-items-center">
        <h5 class="mb-0 mr-3">Редактирование сессии</h5>
    </div>
    <div class="card-body mselect">
        <form action="" class="needs-validation" novalidate id="add" method="post">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <p class="mb-0 fz-14">
                                <?php $ing = \cube\libs\Application::getUser($item['user_id']); ?>
                                <span class="font-weight-bold">Инженер: </span>
                                <!-- /.font-weight-bold --> <?=$ing->title?>
                            </p>
                            <p class="mb-0 fz-14"><span class="font-weight-bold">ID запроса: </span><?=$item['id_sbs']?></p>
                            <p class="mb-0 fz-14"><span class="font-weight-bold">Клиент: </span><?=$item['client_name']?></p>
                            <p class="mb-0 fz-14">
                                <?php $vsp = \cube\libs\Application::getVsp($item['vsp']); ?>
                                <span class="font-weight-bold">ВСП/ГОСБ: </span>
                                <?=$vsp->num . ' ' .$vsp->address;?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <!-- /.col-lg-6 col-sm-12 -->
                <div class="col-lg-6 col-sm-12 md-form mb-0">

                    <select class="mdb-select getType"
                            data-content="ajax-load-equipment"
                            data-action="extradition/get-type"
                            name="type">
                        <?php foreach ($equipment_type as $i): ?>
                            <option value="<?=$i->id?>"><?=$i->title?></option>
                        <?php endforeach; ?>
                    </select>
                    <label class="mdb-main-label fz-14 ml-3 mb-0">Тип оборудования</label>
                    <!--Big blue-->
                    <div class="loader mt-3 justify-content-center">
                        <div class="preloader-wrapper active">
                            <div class="spinner-layer spinner-green-only">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.loader d-flex -->
                </div>
                <!-- /.col-lg-6 col-sm-12 -->
            </div>
            <!-- /.row -->
            <div class="ajax-load-equipment"></div>
            <!-- /.ajax-load-equipment -->
        </form>

        <div class="checked-order">
            <?php if(!empty($equip)): ?>
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
                        <?php if($method['actions'] == '2'): ?>
							<div class="md-form">
								<textarea id="comment" name="comment" class="md-textarea form-control" rows="3"></textarea>
								<label for="comment">Описание неисправности</label>
							</div>
                        <?php endif; ?>
                        <button type="button"
                                data-action="extradition/save-order"
                                class="btn-amber btn btn-md save-all">
                            Сохранить/Закрыть
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>