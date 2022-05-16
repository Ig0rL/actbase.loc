(function ($) {

    var methods = {

        pagination: function (options) {
            var settings = {
                url: location.href,
                preload: 'loader',
                type: 'POST',
                container: 'ajaxToLoader',
            };

            return this.each(function () {
                /**
                 * Если мы передаем свои опции, то они заменяютсЯ
                 * в объекте настроек по умолчанию сохраняя порядок
                 */
                if (options) {
                    $.extend(settings, options);
                }

                var page = $(this).attr('data-page');
                $.ajax({
                    url: settings.url,
                    data: {page: page},
                    type: settings.type,
                    beforeSend: function () {
                        $(settings.preload).fadeIn(200, function () {
                            $(settings.container).fadeOut(800);
                        });
                    },
                    success: function (data) {
                        console.log(data);
                        $(settings.preload).delay(500).fadeOut(300, function () {
                            $(settings.container).html(data).fadeIn(100);
                            var url = location.search.replace(/page(.+?)(&|$)/g, ''); //$2
                            var newURL = location.pathname + url + (location.search ? "&" : "?") + "page=" + page;
                            newURL = newURL.replace('&&', '&');
                            newURL = newURL.replace('?&', '?');
                            history.pushState({}, '', newURL);
                            $('html, body').animate({scrollTop: $('body').offset().top}, 200);

                        });
                    }
                });
            });
        },
        init:function (options, el) {
            var settings = {
                url: location.href,
                type:'POST',
                dType: 'json',
                params:{},
                beforeLoad: function () {},
                callback: function () {}
            };

            if (options) {
                $.extend(settings, options);
            }

            return this.each(function () {
                $.ajax({
                    url: settings.url,
                    type: settings.type,
                    data: settings.params,
                    dataType: settings.dType,
                    beforeSend: function(){
                        settings.beforeLoad();
                    },
                    success: function (dataJson) {
                        settings.callback(dataJson);
                    }
                })
            });
        },
        cart: function (options, el) {
            var settings = {
                defaultOneAjax: {
                    url: location.href,
                    type: 'POST',
                    dType: 'json',
                    params: {},
                    containerPasteJson: {
                        count: 'count',
                        price: 'price'
                    }
                },
                defaultTwoAjax: {
                    url: location.href,
                    type: 'POST',
                    params: {},
                    containerPasteHtml: 'containerFromAjax'
                },
                refreshLink:{
                    classLink: '',
                    disabledLink: true,
                    templateType: 'html',
                    templateTextLink: '',
                    templateHtmlLink: ''
                },
                view: function () {}
            };

            if (options) {
                $.extend(settings, options);
            }

            /*$.each(settings, function (key, value) {
                if(typeof value === 'function') {
                    settings.key = value(el);
                    console.log(settings);
                }
            });*/

            return this.each(function () {
                $.when(
                    $.ajax({
                        url: settings.defaultOneAjax.url,
                        type: settings.defaultOneAjax.type,
                        data: settings.defaultOneAjax.params,
                        dataType: settings.defaultOneAjax.dType,
                        success: function (dataJson) {
                            $('.' + settings.defaultOneAjax.containerPasteJson.count).text(dataJson.cart_qty);
                            $('.' + settings.defaultOneAjax.containerPasteJson.price).text(dataJson.cart_price);
                        }
                    }),
                    $.ajax({
                        url: settings.defaultTwoAjax.url,
                        type: settings.defaultTwoAjax.type,
                        data: settings.defaultTwoAjax.params,
                        dataType: 'html',
                        success: function (dataHtml) {
                            $('.' + settings.defaultTwoAjax.containerPasteHtml).html(dataHtml);
                            if(settings.refreshLink.templateType === 'html') {
                                if(settings.refreshLink.disabledLink == true) {
                                    $('.'+ settings.refreshLink.classLink).attr('disabled', true).html(settings.refreshLink.templateHtmlLink);
                                }else {
                                    $('.'+ settings.refreshLink.classLink).attr('disabled', false).html(settings.refreshLink.templateHtmlLink);
                                }
                            }else {
                                if(settings.refreshLink.disabledLink == true) {
                                    $('.'+ settings.refreshLink.classLink).attr('disabled', true).text(settings.refreshLink.templateTextLink);
                                }else {
                                    $('.'+ settings.refreshLink.classLink).attr('disabled', false).text(settings.refreshLink.templateTextLink);
                                }
                            }

                        }
                    })
                ).then(function (dataJson, dataHtml) {
                    settings.view(dataJson);
                });

            });
        },
        main: function (options) {
            var settings = {
                url: location.href,
                preload: 'loader',
                type: 'POST',
                container: 'ajaxToLoader',
                params: {},
                redirect: ''
            };

            if (options) {
                $.extend(settings, options);
            }

            return this.each(function () {
                $.ajax({
                    url: settings.url,
                    data: settings.params,
                    type: settings.type,
                    beforeSend: function () {
                        $(settings.preload).fadeIn(300, function () {
                            $(settings.container).fadeOut(800);
                        });
                    },
                    success: function (data) {
                        if(settings.redirect !== '') {
                            window.location.href = settings.redirect;
                        }
                        $(settings.preload).delay(500).fadeOut(200, function () {
                            $(settings.container).html(data).fadeIn(100);
                            if(settings.type === 'GET') {
                                var url = location.search.replace(/(.+?)(&|$)/g, "");
                                var newGet = '';
                                $.each(settings.params, function (k, v) {
                                    newGet += k + '=' + v + '&';
                                });
                                if (newGet.charAt(newGet.length - 1) === '&') {
                                    newGet = newGet.substring(0, newGet.length - 1);
                                }
                                if (newGet === '?') {
                                    newGet = newGet.substring(0, -1);
                                }
                                var newURL = location.pathname + url + '?' + (location.search ? "&" : "?") + newGet;
                                newURL = newURL.replace('&&', '&');
                                newURL = newURL.replace('?&', '?');
                                //console.log(newURL);
                                history.pushState({}, '', newURL);
                            }

                        });
                    }
                });
            });
        },
        forms: function (options) {
            /**
             * Настройки плагина по умолчанию
             * @type {{Принимает объект}}
             */
            var settings = {
                url: location.href,
                type: 'POST',
                dType: '',
                form: '',
                beforeLoad: function () {},
                callback: function (data) {}
            };
            return this.each(function () {
                /**
                 * Если мы передаем свои опции, то они заменяютсЯ
                 * в объекте настроек по умолчанию сохраняя порядок
                 */
                if (options) {
                    $.extend(settings, options);
                }

                var fields = $(settings.form).find(":input").serializeArray();


                $.ajax({
                    url: settings.url,
                    type: settings.type,
                    dataType: settings.dType,
                    data: {fields},
                    beforeSend: function(){
                        settings.beforeLoad();
                    },
                    success: function (dataJson) {
                        settings.callback(dataJson);
                    }
                });

            });
        }
    }

    $.fn.ajaxzabro = function (method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Метод ' + method + ' не существует!');
        }
    }
})(jQuery);