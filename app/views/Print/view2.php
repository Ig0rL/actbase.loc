<p class="text-right">
    Приложение №15 <br>
    к Генеральному соглашению № 2560992 <br>
    от "___"_____________2018г.
</p>
<p class="text-center m-0">
    <strong>Акт замены/изъятия ИТ-оборудования №___________</strong>
</p>
<p class="text-center m-0">
    к Генеральному соглашению №______от "___"___________201__г.
</p>
<!-- /.text-center -->
<p>
    <span class=""><?=$vsp->address?>, </span>
    <span class="text-center"><?= getDateTranslite("j F Y" . " г. " . "", strtotime($item->date_save)) ?></span>
</p>
<p>
    Настоящим актом подтверждается, что в рамках оказания Услуг по Генеральному соглашению на оказание ИТ-услуг по технической поддержке №________________ от "___"_______________201__г. с целью проведения ремонтных работ по заявке: <strong><?=$item->id_sbs?></strong>
</p>
<p>
    1. Исполнитель изъял следующие оборудование:
</p>
<!-- /.text-center -->
<table class="table" cellpadding="8" cellspacing="0">
    <thead>
    <th>№ п/п</th>
    <th>Серийный номер/Инвентарный номер</th>
    <th>Наименование</th>
    <th>№ ВСП</th>
    <th>Адрес расположения оборудования</th>
    <th>ФИО МОЛ <br> (материально ответственное лицо)</th>
    </thead>
    <tbody>
    <?php $count = 1; ?>
    <?php $str = ''; ?>
    <?php foreach ($items as $i): ?>
    <?php if($i->actions == '0'): ?>
        <tr>
            <td><?=$count?></td>
            <td>
                <?php if($i->serial_num == '' && $i->inv_num == ''): ?>
                    Отсутствует
                <?php else: ?>
                    <?=$i->serial_num?> / <?=$i->inv_num?>
                <?php endif; ?>
            </td>
            <?php $type = \cube\libs\Application::getTypeEquip($i->equip_type_id); ?>
            <td><?=$type->title?>: <?=$i->equip_name?></td>
            <?php $vsp = \cube\libs\Application::getVsp($item->vsp); ?>
            <td>
                <?=$vsp->num?>
            </td>
            <td><?=$vsp->address?></td>
            <td></td>
        </tr>
        <?php $str .= $type->title . ': ' . $i->equip_name . ', '; ?>
        <?php $count++; ?>
    <?php endif; ?>
    <?php endforeach; ?>
    </tbody>
</table>
<p>
    <strong>Описание неисправности: </strong><?=$item->comment != '' ? $item->comment : ''?>
</p>
<p>
2. Взамен изъятого оборудования Исполнитель передал следующее оборудование:
</p>
<table class="table" cellpadding="8" cellspacing="0">
    <thead>
    <th>№ п/п</th>
    <th>Серийный номер/Инвентарный номер</th>
    <th>Наименование</th>
    <th>№ ВСП</th>
    <th>Адрес расположения оборудования</th>
    <th>ФИО МОЛ <br> (материально ответственное лицо)</th>
    </thead>
    <tbody>
    <?php $count2 = 1; ?>
    <?php $str = ''; ?>
    <?php foreach ($items as $i): ?>
        <?php if($i->actions == '1'): ?>
            <tr>
                <td><?=$count?></td>
                <td>
                    <?php if($i->serial_num == '' && $i->inv_num == ''): ?>
                        Отсутствует
                    <?php else: ?>
                        <?=$i->serial_num?> / <?=$i->inv_num?>
                    <?php endif; ?>
                </td>
                <?php $type = \cube\libs\Application::getTypeEquip($i->equip_type_id); ?>
                <td><?=$type->title?>: <?=$i->equip_name?></td>
                <?php $vsp = \cube\libs\Application::getVsp($item->vsp); ?>
                <td>
                    <?=$vsp->num?>
                </td>
                <td><?=$vsp->address?></td>
                <td></td>
            </tr>
            <?php $str .= $type->title . ': ' . $i->equip_name . ', '; ?>
            <?php $count2++; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    </tbody>
</table><br>
<div class="f-left w-50">
    <p class="m-0"><strong>Оборудование заменил:</strong></p>
    <p class="m-0"><strong>Инженер: </strong><?=$ing->title?></p>
    <p class="m-0"><strong>Телефон: </strong>+7 <?=$ing->phone?></p><br>
    <p class=""><strong>Подпись:</strong>______________</p>
</div><!-- /.f-left w-50 -->
<div class="f-left w-50">
    <p class="m-0"><strong>Оборудование принял:</strong></p>
    <p class="m-0"><?=$item->client_name?></p><br>
    <p class=""><strong>Подпись:</strong>______________</p>
</div><!-- /.f-left w-50 -->