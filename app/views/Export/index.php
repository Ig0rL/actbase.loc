<div class="card z-depth-5">
    <div class="card-header bg-white d-flex align-items-center">
        <h5 class="mb-0 mr-3">Выгрузка</h5>
    </div>
    <div class="card-body mselect">
        <form action="export/to-exl" method="post" id="view-exp">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="md-form">
                        <input placeholder="Выбрать дату..." name="start-date" type="text" id="date_start" class="form-control datepicker">
                        <label for="date_start">С какой даты</label>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="md-form">
                        <input placeholder="Выбрать дату..." type="text" name="end-date" id="date_end" class="form-control datepicker">
                        <label for="date_end">По какую дату</label>
                    </div>
                </div>
                <!-- /.col-lg-6 col-sm-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="md-form col-lg-6 col-sm-12">
                    <select name="user" class="mdb-select sexp md-form mt-0 mb-0" searchable="Поиск...">
                        <option value="">Без инженера</option>
                        <?php foreach ($users as $u): ?>
                        <option value="<?=$u->id?>"><?=$u->title?></option>
                        <?php endforeach; ?>
                    </select>
                    <label class="mdb-main-label fz-14 ml-3 mb-0">По инженеру</label>
                </div>
                <!-- Medium input -->
            </div>
            <button type="button"
                    data-action="export/get"
                    data-form="#view-exp"
                    data-content="get-content-ajax"
                    class="btn btn-primary btn-md get-btn">
                Показать
            </button>
            <div class="getXls d-inline-block">

            </div>
            <!-- /.getXls -->
        </form>
        <div class="row get-content-ajax"></div>
        <!-- /.row -->
    </div>
</div>
