<?php if(empty($periferia)): ?>
<div class="md-form form-sm">
    <input required type="text" id="serial" name="serial_num" class="form-control form-control-sm col-lg-6 col-sm-12">
    <label for="serial">Серийный номер</label>
</div>
<div class="md-form form-sm">
    <input required type="text" id="inventar" name="inv_num" class="form-control col-lg-6 col-sm-12">
    <label for="inventar">Инвентарный номер</label>
</div>
<div class="md-form mb-3 form-sm">
    <input required type="text" id="name" name="equipment_name" class="form-control col-lg-6 col-sm-12">
    <label for="name">Название/Модель</label>
</div>
<!-- Material checked -->
<?php else: ?>
<div class="mt-3"></div>
<!-- /.mt-3 -->
<?php foreach ($periferia as $p): ?>
<div class="form-check  pl-0">
    <input type="checkbox" name="perf" value="<?=$p->id?>" class="form-check-input perfo" id="p_<?=$p->id?>">
    <label class="form-check-label" for="p_<?=$p->id?>"><?=$p->title?></label>
</div>
<?php endforeach; ?>
<div class="row">
    <div class="col-sm-6">
        <hr>
    </div>
    <!-- /.col-sm-6 -->
</div>
<?php endif; ?>
<!-- /.row -->

<!-- Material unchecked disabled -->
<div class="form-check pl-0">
    <input type="radio" value="0" class="form-check-input" id="distroy" name="action">
    <label class="form-check-label" for="distroy">Изъятие</label>
</div>
<!-- Material checked disabled -->
<div class="form-check pl-0 mb-3">
    <input type="radio" checked value="1" class="form-check-input" id="new" name="action">
    <label class="form-check-label" for="new">Выдача</label>
</div>
<button type="button"
		data-action="extradition/add-order"
		data-content="checked-order"
		data-form="#add"
		class="btn btn-primary add-row btn-md">Добавить в список</button>