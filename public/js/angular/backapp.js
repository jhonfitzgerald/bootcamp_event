'use strict';

var app = angular.module('app', [
    'ngAnimate',
    'ngResource',
    'ui.bootstrap',
    'ui.bootstrap.fontawesome',
    'ngSanitize',
    'blockUI'
]);

app.config(function(blockUIConfig) {
    blockUIConfig.message = 'Cargando';
});

app.filter('startFrom', function() {
    return function(input, start) {
        var outPut = [];
        if (input) {
            start = +start;
            outPut = input.slice(start);
            return outPut;
        }
        return outPut;
    };
});

app.directive('ngEnter', function() {
    return function(scope, element, attrs) {
        element.bind('keydown keypress', function(event) {
            if (event.which === 13) {
                scope.$apply(function() {
                    scope.$eval(attrs.ngEnter);
                });
                event.preventDefault();
            }
        });
    };
});

app.run(function($rootScope, $sce, $filter) {
    $rootScope.pager = {
        objects: [],
        currentPage: 1,
        pageSize: 20,
        pageDivide: 6,
        numberPage: 0,
        pages: [],
        year_work: new Date().getFullYear()
    };

    $rootScope.value = { me: 140913191424, alter: 101201020509 };

    $rootScope.basic = { date: {} };
    $rootScope.filterPager = {};

    $rootScope.validateForm = function(form) {
        if (form.$valid) {
            showModal('#showQuestion');
        } else {
            $.notify({
                icon: 'fa fa-exclamation-circle',
                title: 'Alerta!',
                message: 'Error de Validación Asegurese de Ingresar todos los campos (*)',
            }, { type: 'danger', z_index: 2000 });
        }
    };

    $rootScope.datesingles = function() {
        $rootScope.basic.date.months = [{ 'id': '1', 'name': 'Enero' }, { 'id': '2', 'name': 'Febrero' }, { 'id': '3', 'name': 'Marzo' }, { 'id': '4', 'name': 'Abril' }, { 'id': '5', 'name': 'Mayo' }, { 'id': '6', 'name': 'Junio' }, { 'id': '7', 'name': 'Julio' },
            { 'id': '8', 'name': 'Agosto' }, { 'id': '9', 'name': 'Septiembre' }, { 'id': '10', 'name': 'Octubre' }, { 'id': '11', 'name': 'Noviembre' }, { 'id': '12', 'name': 'Diciembre' }
        ];
        $rootScope.basic.date.years = $rootScope.setNumbers(1900, new Date().getFullYear());
    };

    $rootScope.setDateDays = function(year, month) {
        if (year != undefined && month != undefined) {
            var n = 0;
            if (['1', '3', '5', '7', '8', '10', '12'].indexOf(month) >= 0)
                n = 31;
            else if (['4', '6', '9', '11'].includes(month))
                n = 30;
            else {
                if (month == 2)
                    n = (((year % 4) == 0 && (year % 100) != 0) || ((year % 400) == 0)) ? 29 : 28;
            }
            $rootScope.basic.date.days = $rootScope.setNumbers(1, n);
        } else {
            $rootScope.basic.date.days = [];
        }
    };

    $rootScope.setNumbers = function(start, end, type) {
        var array = [];
        for (let i = start != undefined ? start : 0, n = end; i <= n; i++) {
            array.push(i);
        }
        return array;
    };

    $rootScope.changePage = function(number) {
        $rootScope.pager.currentPage = (number - 1);
    };

    $rootScope.numberOfPages = function(sizeList) {
        if (sizeList > 0) {
            $rootScope.pager.numberPage = Math.ceil(sizeList / $rootScope.pager.pageSize);
            for (var i = 0; i < $rootScope.pager.numberPage; i++) {
                $rootScope.pager.pages.push((i + 1));
            }
            $rootScope.pager.total = sizeList;
        }
    };

    $rootScope.searchFilter = function(dataList, inputSearch) {
        var out = $filter('filter')(dataList, inputSearch);
        if (out != undefined) {
            $rootScope.pager.pages = [];
            $rootScope.numberOfPages(out.length);
        }
        return out;
    };

    $rootScope.search = function(toSearch) {
        var out = [];
        out = $rootScope.searchFilter($rootScope.pager.objects, toSearch.trim());
        return out;
    };

    $rootScope.allowHtml = function(text) {
        if (text !== undefined && text !== null) {
            text = text.replace(/\n/g, "<br />");
            return $sce.trustAsHtml(text);
        }
        return null;
    };

    $rootScope.hideModal = function(idModal) {
        idModal !== undefined ? $(idModal).modal('hide') : $('.modal').modal('hide');
    };

    $rootScope.showModal = function(modalInput) {
        $(modalInput).modal({
            keyboard: false,
            backdrop: false
        });
    };

    $rootScope.today = function(language) {
        var date;
        var date_today = new Date();
        var dd = date_today.getDate();
        var mm = (date_today.getMonth() + 1);
        if (dd < 10) { dd = '0' + dd; }
        if (mm < 10) { mm = '0' + mm; }
        switch (language) {
            case 'es':
                date = dd + '/' + mm + '/' + date_today.getFullYear();
                break;
            case 'en':
                date = date_today.getFullYear() + "-" + mm + '-' + dd;
                break;
            default:
                date = dd + '/' + mm + '/' + date_today.getFullYear();
        }
        return date;
    };

    $rootScope.date = function(input) {
        if (input != undefined) {
            var custom_date = input.split('-');
            return new Date(custom_date[0], navigator.language == 'en-US' ? (parseInt(custom_date[1]) - 1) : custom_date[1], custom_date[2]);
        }
    };

    $rootScope.formatDate = function(dateinput, language, type) {
        var response = '';
        if (dateinput !== undefined) {
            var dateInput = new Date(dateinput);
            if (type === undefined)
                var date = new Date(dateInput.getFullYear(), (dateInput.getMonth() + 1), (dateInput.getDate() + 1));
            else
                var date = new Date(dateInput.getFullYear(), (dateInput.getMonth() + 1), (dateInput.getDate()));
            var dd = date.getDate();
            var mm = date.getMonth();
            if (dd < 10) { dd = '0' + dd; }
            if (mm < 10) { mm = '0' + mm; }
            switch (language) {
                case 'es':
                    response = dd + "/" + mm + "/" + date.getFullYear();
                    break;
            }
        }
        return response;
    };

    $rootScope.formatHour = function(fecha) {
        var fec = new Date(fecha);
        var hora = fec.getHours();
        var minutos = fec.getMinutes();
        if (hora < 10) { hora = '0' + hora; }
        if (minutos < 10) { minutos = '0' + minutos; }
        return hora + ':' + minutos;
    }

    $rootScope.capitalize = function(string) {
        if (string != undefined) {
            string = string.toLowerCase();
            var pieces = string.split(" ");
            if (pieces.length > 0) {
                for (var i = 0; i < pieces.length; i++) {
                    var j = pieces[i].charAt(0).toUpperCase();
                    pieces[i] = j + pieces[i].substr(1);
                }
            }
            // return string[0].toUpperCase() + string.slice(1);
            return pieces.join(" ");
        }

    };

    $rootScope.zeroPad = function(num, places) {
        var zero = places - num.toString().length + 1;
        return Array(+(zero > 0 && zero)).join("0") + num;
    };

    $rootScope.soloNumeros = function(e) {
        var key = window.Event ? e.which : e.keyCode
        return (key >= 48 && key <= 57)
    };

    $rootScope.operDate = function(date, days) {
        if (date != undefined) {
            date.setDate(date.getDate() + days);
            return date;
        }
    };

    $rootScope.unique = function(array) {
        var a = array.concat();
        for (var i = 0; i < a.length; ++i) {
            for (var j = i + 1; j < a.length; ++j) {
                if (a[i] === a[j])
                    a.splice(j--, 1);
            }
        }
        return a;
    };

    $rootScope.validarPatternEmail = function(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    };

    $rootScope.existOnList = function(array, code, column) {
        if (code != undefined && column != undefined && code != '' && column != '') {
            for (let i = 0, n = array.length; i < n; i++) {
                if (array[i][column] === code) {
                    return i;
                }
            }
            return -1;
        }
    };
});
