(function ($) {
    "use strict";

    $(document).ready(function(){
        qodefSearchCoversHeader.init();
    });

    var qodefSearchCoversHeader = {
        init: function(){
            var $searchOpener = $('a.qodef-search-opener');

            if ($searchOpener.length) {
                qodef.body.prepend('<div class="qodef-search-area-cover"></div>');

                $('.qodef-search-area-cover').on('click', function() {
                    qodefSearchCoversHeader.closeCoversHeader($('.qodef-search-cover'));
                });

                $searchOpener.each(function() {
                    var $thisSearchOpener = $(this),
                        $thisSearchForm = $thisSearchOpener.closest('.qodef-widget-holder').parent().find('.qodef-search-cover'),
                        $thisSearchClose = $thisSearchForm.find('.qodef-search-close');

                    $thisSearchOpener.on('click', function (e) {
                        e.preventDefault();
                        qodefSearchCoversHeader.openCoversHeader($thisSearchForm);
                    });
                    $thisSearchClose.on('click', function (e) {
                        e.preventDefault();
                        qodefSearchCoversHeader.closeCoversHeader($thisSearchForm);
                    });
                });
            }
        },
        
        openCoversHeader: function($searchForm){
            // close every search cover
            $('.qodef-search-field').removeClass('qodef-covers-search--fadein');
            qodef.body.removeClass('qodef-covers-search--opened');
            $('.qodef-search-area-cover').removeClass('qodef-search-area-cover--opened');

            qodef.body.addClass('qodef-covers-search--opened');
            $searchForm.addClass('qodef-covers-search--fadein');
            $('.qodef-search-area-cover').addClass('qodef-search-area-cover--opened');

            $(window).one('scroll', function() {
                qodefSearchCoversHeader.closeCoversHeader($('.qodef-search-cover'));
            });

            setTimeout(function () {
                $searchForm.find('.qodef-search-field').focus();
            }, 300);
        },
        closeCoversHeader: function($searchForm){
            qodef.body.removeClass('qodef-covers-search--opened');
            $searchForm.removeClass('qodef-covers-search--fadein');
            $('.qodef-search-area-cover').removeClass('qodef-search-area-cover--opened');

            setTimeout(function () {
                $searchForm.find('.qodef-search-field').val('');
                $searchForm.find('.qodef-search-field').blur();
            }, 300);
        }
    };

})(jQuery);
