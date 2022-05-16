$(function () {

    $('body').on('click', '.del-row', function (e) {
        e.preventDefault();
        var res = confirm('Удалить позицию?');
        if(!res) return false;
        var attr = $(this).attrs();
        $(this).ajaxzabro('init', {
            url:attr.dataAction,
            type: 'POST',
            dType: 'html',
            params:attr,
            callback: function (data) {
                $('.' + attr.dataContent).html(data);
            }
        });
        return false;
    });

    $('body').on('click', '.save-all', function (e) {
        e.preventDefault();
        var attr = $(this).attrs();
        var _this = $(this);
        attr.comment = $('#comment').val();
        $(this).ajaxzabro('init', {
            url:attr.dataAction,
            type: 'POST',
            dType: 'html',
            params:attr,
            beforeLoad: function () {
                _this.html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Загрузка...').addClass('disabled');
            },
            callback: function (data) {
                setTimeout(function(){
                    _this.text('Сохранить/Закрыть').removeClass('disabled');
                    window.location.href = "/extradition";
                }, 1000);
            }
        });
    });

    $('body').on('click', '.add-row', function () {
        var attr = $(this).attrs();
        var _this = $(this);
        var count = 0;
        $(attr.dataForm + ' :input[required]').each(function () {
            if ($(this).val() === '') {
                $(attr.dataForm).addClass('was-validated');
                count++;
            }
        });
        if (count != 0) {
            return false;
        }else {
            $(this).ajaxzabro('forms', {
                url: attr.dataAction,
                type: 'POST',
                dtype: 'html',
                form: attr.dataForm,
                beforeLoad: function () {
                    _this.html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Загрузка...').addClass('disabled');
                },
                callback: function (data) {
                    setTimeout(function(){
                        _this.text('Добавить в список').removeClass('disabled');
                        $('.' + attr.dataContent).html(data);
                        $(attr.dataForm)[0].reset();
                        $(attr.dataForm).find('label').removeClass('active');
                        $('.ajax-load-equipment').empty();
                    }, 1000);
                }
            });
        }
    });

    $('body').on('change', '.getType', function () {
        var attr = $(this).attrs();
        var id = $(this).val();
        attr.id = id;
        $(this).ajaxzabro('init', {
            url: attr.dataAction,
            type: 'POST',
            dType: 'html',
            params: attr,
            beforeLoad: function () {
                $('.' + attr.dataContent).empty();
                $('.loader').addClass('d-flex').fadeIn(10);
            },
            callback: function (data) {
                $('.loader').delay(500).fadeOut(10, function () {
                    $('.' + attr.dataContent).html(data);
                    $(this).removeClass('d-flex');
                });
            }
        });
    });

    $('body').on('click', '.add-html', function (e) {
        e.preventDefault();
        var attr = $(this).attrs();
        var _this = $(this);
        var count = 0;
        $(attr.dataForm + ' :input[required]').each(function () {
            if ($(this).val() === '') {
                $(attr.dataForm).addClass('was-validated');
                count++;
            }
        });
        if (count != 0) {
            return false;
        }else {
            $(this).ajaxzabro('forms', {
                url: attr.dataAction,
                type: 'POST',
                dtype: 'html',
                form: attr.dataForm,
                beforeLoad: function () {
                    _this.html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Загрузка...').addClass('disabled');
                },
                callback: function (data) {
                    setTimeout(function(){
                        $('.' + attr.dataContent).html(data);
                    }, 1000);
                }
            });
        }
    });
    $('body').on('click', '.for-exl', function () {
        var attr = $(this).attrs();
        var _this = $(this);
        _this.ajaxzabro('forms', {
            url: attr.dataAction,
            type: 'POST',
            dType: 'html',
            form: attr.dataForm,
            beforeLoad: function () {
                _this.html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Загрузка...').addClass('disabled');
            },
            callback: function (res) {
                console.log(res);
                setTimeout(function(){
                    $('.' + attr.dataContent).html(res);
                }, 1000);
            }
        });
    });
    $('body').on('click', '.get-btn', function () {
        var attr = $(this).attrs();
        var _this = $(this);
        _this.ajaxzabro('forms', {
            url: attr.dataAction,
            type: 'POST',
            dType: 'html',
            form: attr.dataForm,
            beforeLoad: function () {
                _this.html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Загрузка...').addClass('disabled');
            },
            callback: function (res) {
                console.log(res);
                setTimeout(function(){
                    $('.' + attr.dataContent).html(res);
                    _this.text('Показать').removeClass('disabled');
                    $('.getXls').html('<button type="button" data-content="getXls" data-action="export/to-exl" data-form="#view-exp" class="btn btn-amber btn-md for-exl">Сформировать Excel</button>');
                }, 1000);
            }
        });
    });
    $('body').on('click', '.add-form', function (e) {
        e.preventDefault();
        var attr = $(this).attrs();
        var _this = $(this);
        var count = 0;
        $(attr.dataForm + ' :input[required]').each(function () {
            if ($(this).val() === '') {
                $(attr.dataForm).addClass('was-validated');
                count++;
            }
        });
        if (count != 0) {
            return false;
        }else {
            $(this).ajaxzabro('forms', {
                url: attr.dataAction,
                type: 'POST',
                dtype: 'json',
                form: attr.dataForm,
                beforeLoad: function () {
                    _this.html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Загрузка...').addClass('disabled');
                },
                callback: function (res) {
                    var obj = jQuery.parseJSON(res);
                    setTimeout(function(){
                        if(obj.error) {
                            $('.answer').text(obj.error).addClass('text-danger');
                            _this.text('Добавить').removeClass('disabled');
                            setTimeout(function () {
                                $('.answer').text('').removeClass('text-danger'). fadeOut(100);
                            }, 2000);
                        }
                        if(obj.success) {
                            _this.text('Добавить').removeClass('disabled');
                            $('.answer').text(obj.success).addClass('text-success');
                            setTimeout(function () {
                                $('.answer').text('').removeClass('text-success'). fadeOut(100);
                            }, 2000);
                            $(attr.dataForm)[0].reset();
                            $(attr.dataForm).find('label').removeClass('active');
                            $(attr.dataForm).find('.fas').removeClass('active');
                        }
                    }, 1000);
                }
            });
        }

    });
});
/**
 * Метод получения все атрибутов элемента
 */
(function(old) {
    $.fn.attrs = function() {
        if(arguments.length === 0) {
            if(this.length === 0) {
                return null;
            }

            var obj = {};
            $.each(this[0].attributes, function() {
                if(this.specified) {
                    var str = this.name.split('-');
                    if(str[1]) {
                        str = str[0] + str[1].charAt(0).toUpperCase() + str[1].slice(1).toLowerCase();
                    }
                    obj[str] = this.value;
                }
            });
            return obj;
        }

        return old.apply(this, arguments);
    };
})($.fn.attr);
