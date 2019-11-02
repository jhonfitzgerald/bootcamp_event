$.navigation = $('nav > ul.nav');
$.panelIconOpened = 'icon-arrow-up';
$.panelIconClosed = 'icon-arrow-down';
$.brandPrimary = '#20a8d8';
$.brandSuccess = '#4dbd74';
$.brandInfo = '#63c2de';
$.brandWarning = '#f8cb00';
$.brandDanger = '#f86c6b';
$.grayDark = '#2a2c36';
$.gray = '#55595c';
$.grayLight = '#818a91';
$.grayLighter = '#d1d4d7';
$.grayLightest = '#f8f9fa';

$(document).ready(function($) {

    $.navigation.on('click', 'a', function(e) {
        if ($.ajaxLoad) {
            e.preventDefault();
        }
        if ($(this).hasClass('nav-dropdown-toggle')) {
            $(this).parent().toggleClass('open');
            resizeBroadcast();
        }
    });

    function resizeBroadcast() {
        var timesRun = 0;
        var interval = setInterval(function() {
            timesRun += 1;
            if (timesRun === 5) {
                clearInterval(interval);
            }
            window.dispatchEvent(new Event('resize'));
        }, 62.5);
    }

    $('.navbar-toggler').click(function() {
        if ($(this).hasClass('sidebar-toggler')) {
            $('body').toggleClass('sidebar-hidden');
            resizeBroadcast();
        }

        if ($(this).hasClass('sidebar-minimizer')) {
            $('body').toggleClass('sidebar-minimized');
            resizeBroadcast();
        }

        if ($(this).hasClass('aside-menu-toggler')) {
            $('body').toggleClass('aside-menu-hidden');
            resizeBroadcast();
        }

        if ($(this).hasClass('mobile-sidebar-toggler')) {
            $('body').toggleClass('sidebar-mobile-show');
            resizeBroadcast();
        }

    });

    $('.sidebar-close').click(function() {
        $('body').toggleClass('sidebar-opened').parent().toggleClass('sidebar-opened');
    });

    $('a[href="#"][data-top!=true]').click(function(e) {
        e.preventDefault();
    });

    $(function() {
        hideModal = function(idModal) {
            idModal !== undefined ? $(idModal).modal('hide') : $('.modal').modal('hide');
        };
        showModal = function(modalInput) {
            $(modalInput).modal({
                keyboard: false,
                backdrop: false
            });
        };
        justNumbers = function(e) {
            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 0))
                return true;
            return /\d/.test(String.fromCharCode(keynum));
        };
        justDecimals = function(e, input) {
            var charCode = (e.which) ? e.which : e.keyCode;
            if (charCode == 46) {
                //Check if the text already contains the . character
                if (input.value.indexOf('.') === -1) {
                return true;
                } else {
                return false;
                }
            } else {
                if (charCode > 31 &&
                (charCode < 48 || charCode > 57))
                return false;
            }
            return true;
        };
    });
});

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function init(url) {
    $('[rel="tooltip"],[data-rel="tooltip"]').tooltip({ "placement": "bottom", delay: { show: 400, hide: 200 } });
    $('[rel="popover"],[data-rel="popover"],[data-toggle="popover"]').popover();

}
