$(document).ready(function () {
    setTimeout(function () {
        $('.a-success').empty();
    }, 2000);
    $('.material-tooltip-main').tooltip({
        template: '<div class="tooltip md-tooltip-email"><div class="tooltip-arrow md-arrow"></div><div class="tooltip-inner md-inner-email"></div></div>'
    });
    $('.mdb-select').materialSelect();
    var test = $('.mdb-select.select-wrapper .select-dropdown').val("").removeAttr('readonly').prop('required', true).addClass('form-control').css('background-color', '#fff');
    var test = $('.sexp.select-wrapper .select-dropdown').val("").removeAttr('readonly').prop('required', false).addClass('form-control').css('background-color', '#fff');
    $('.datepicker').pickadate({
        // Strings and translations
        monthsFull: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь',
            'Ноябрь', 'Декабрь'],
        monthsShort: ['Янв', 'Фев', 'Мрт', 'Апр', 'Май', 'Ин', 'Ил', 'Авг', 'Сен', 'Окт', 'Ноб', 'Дек'],
        weekdaysFull: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
        weekdaysShort: ['Вск', 'Пон', 'Втр', 'Срд', 'Чет', 'Пят', 'Суб'],
        showMonthsShort: undefined,
        showWeekdaysFull: undefined,
        formatSubmit: 'yyyy-mm-dd',

// Buttons
        today: 'Сегодня',
        clear: 'Очистить',
        close: 'Закрыть',

// Accessibility labels
        labelMonthNext: 'Следующий месяц',
        labelMonthPrev: 'Предыдущий месяц',
        labelMonthSelect: 'Select a month',
        labelYearSelect: 'Select a year',
    });
    $('.mselect').find('.select-dropdown').addClass('mb-0');
    $('#phone').inputmask({
        mask: '(999)999-9999',
        showMaskOnHover: false,
        showMaskOnFocus: false
    });
    $('#phone').blur(function () {
        var $input = $(this).val();
        if($input === '') {
            $(this).parent().find('.fas').removeClass('active');
            $(this).parent().find('label').removeClass('active');
        }else {
            $(this).parent().find('.fas').removeClass('active');
        }
    });
    $('#dtMaterialDesignExample').DataTable({
        order: [[ 3, "asc" ]],
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

});
