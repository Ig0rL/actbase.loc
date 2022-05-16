<script>
    $('.mdb-select').materialSelect();
    $('.mdb-select.select-wrapper .select-dropdown').val("").removeAttr('readonly').prop('required', true).addClass('form-control').css('background-color', '#fff');
</script>
<div class="card z-depth-5">
    <div class="card-header bg-white d-flex align-items-center">
        <h5 class="mb-0 mr-3">Оборудование</h5>
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

		<div class="checked-order"></div>

    </div>
</div>