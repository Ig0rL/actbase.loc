<div class="card z-depth-5">
    <div class="card-header bg-white d-flex align-items-center">
        <h5 class="m-0 flex-fill">Добавить инженера</h5>
    </div>
    <div class="card-body">
		<!-- /.ajax-load -->
        <form action="" class="needs-validation" novalidate id="add-user" method="post">
            <div class="row">
                <div class="md-form form-sm select-icon mb-0 col-lg-6 col-sm-12">
                    <i class="fas fa-users prefix"></i>
                    <select required name="sub_id" class="mdb-select" searchable="Поиск...">
						<?php foreach ($subs as $s): ?>
                        <option value="<?=$s->id?>"><?=$s->title?></option>
						<?php endforeach; ?>
                    </select>
                    <label class="mdb-main-label fz-14 ml-3 mb-0">Подразделение</label>
                </div>
            </div>
            <!-- /.row -->
            <div class="md-form form-sm">
                <i class="fas fa-user prefix"></i>
                <input value="" required type="text" name="title" id="name" class="form-control mdb-input-style col-lg-6 col-sm-12">
                <label for="name">ФИО инженера</label>
            </div>
            <div class="md-form form-sm">
                <i class="fas fa-envelope-open prefix"></i>
                <input required type="text" id="email" name="email" class="mdb-input-style form-control col-lg-6 col-sm-12">
                <label for="email">Почта Sigma</label>
            </div>
            <div class="md-form form-sm">
                <i class="fas fa-phone prefix"></i>
                <input required type="text" id="phone" name="phone" placeholder="" class="mdb-input-style form-control col-lg-6 col-sm-12">
                <label for="phone">Мобильный номер</label>
            </div>
            <div class="md-form form-sm">
                <i class="fas fa-arrow-right prefix"></i>
                <input required type="text" id="tabel" name="tabel" class="mdb-input-style form-control col-lg-6 col-sm-12">
                <label for="tabel">Табельный номер инженера</label>
            </div>
            <div class="md-form form-sm">
                <i class="fas fa-location-arrow prefix"></i>
                <input required type="text" id="location" name="location" class="mdb-input-style form-control col-lg-6 col-sm-12">
                <label for="location">Локация инженера</label>
            </div>
            <button type="submit"
					data-form="#add-user"
					data-action="user/add"
					class="btn btn-amber btn-md add-form">
                Добавить
            </button>
			<span class="answer fz-14"></span>
			<!-- /.t -->
        </form>
    </div>
</div>