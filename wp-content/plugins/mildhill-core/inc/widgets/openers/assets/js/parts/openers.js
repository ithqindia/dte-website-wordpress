(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefOpener.init();
    });

    var qodefOpener = {
        init: function () {
            var $opener = $('a.qodef-opener-widget');
            $opener.each(function () {
                qodefOpener.openerHoverColor($(this));
            });
        },

        openerHoverColor: function (opener) {
            if (typeof opener.data('hover-color') !== 'undefined') {
                var hoverColor = opener.data('hover-color'),
                    originalColor = opener.css('color');

                opener.on('mouseenter', function () {
                    opener.css('color', hoverColor);
                });
                opener.on('mouseleave', function () {
                    opener.css('color', originalColor);
                });
            }
        },
    };

})(jQuery);
