<div class="ajax-load">
    <div class="card z-depth-5">
        <div class="card-header bg-white d-flex align-items-center">
            <h5 class="mb-0 mr-3">Выдача</h5>
        </div>
        <div class="card-body">
            <div class="row">
		  <?php if (isset($_SESSION['success'])): ?>
                          <div class="col-lg-6 col-sm-12 a-success">
                              <div class="card text-white bg-success mb-3" style="max-width: 20rem;">
                                  <div class="card-body">
                                      <p class="card-title m-0"><?= $_SESSION['success'] ?></p>
                                  </div>
                              </div>
                          </div>
			  <?php unset($_SESSION['success']); ?>
		  <?php endif; ?>
                <!-- /.col-lg-6 col-sm-12 -->
            </div>
            <form action="" class="needs-validation" novalidate id="add" method="post">
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-6 col-sm-12 md-form mb-0 mselect">

                        <select class="mdb-select" name="user_id" searchable="Поиск...">
			    <?php foreach ($items as $i): ?>
                                      <option value="<?= $i->id ?>"><?= $i->title ?></option>
			    <?php endforeach; ?>
                        </select>
                        <label class="mdb-main-label fz-14 ml-3 mb-0">Инженер</label>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="md-form form-sm">
                            <input required type="text" name="id_sbs" id="order_id" class="form-control">
                            <label for="order_id">ID заявки СБС</label>
                        </div>
                    </div>
                    <!-- /.col-lg-6 col-sm-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="md-form mt-0 form-sm">
                            <input required type="text" id="client" name="client_name" class="form-control">
                            <label for="client">ФИО/табель кому выдается/изымается оборудование</label>
                            <p class="text-muted">
                                <small>
                                    Пример: Иванов Иван Иванович/774562
                                </small>
                            </p>
                        </div>
                    </div>
                    <!-- /.col-lg-6 col-sm-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-6 col-sm-12 md-form mb-4 mt-0 mselect">

                        <select class="mdb-select" name="vsp" searchable="Поиск...">
			    <?php foreach ($vsp as $v): ?>
                                      <option value="<?= $v->id ?>"><?= $v->num ?> (<?= $v->address ?>)</option>
			    <?php endforeach; ?>
                        </select>
                        <label class="mdb-main-label fz-14 ml-3 mb-0">ВСП</label>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-12 md-form mb-4 mt-0 mselect">

                        <select class="mdb-select"
                                name="actions">
                            <option value="0">Выдача</option>
                            <option value="1">Изъятие</option>
                            <option value="2">Замена</option>
                        </select>
                        <label class="mdb-main-label fz-14 ml-3 mb-0">Тип действия</label>
                    </div>
                </div>

                <button type="submit"
                        data-form="#add"
                        data-action="extradition/step-one"
                        data-content="ajax-load"
                        class="btn btn-amber btn-md add-html">
                    Далее
                </button>
            </form>
        </div>
    </div>
</div>
<!-- /.ajax-load -->

