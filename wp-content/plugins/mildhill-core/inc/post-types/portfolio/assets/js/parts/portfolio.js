(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefPortfolio.init();
    });


    var qodefPortfolio = {
        init: function () {
            this.holder = $('.qodef-portfolio-info-sticky-holder');
            if (this.holder.length) {

                var params = {
                    self: this.holder,
                    infoHolder: this.holder.parent(),
                    infoHolderOffset: this.holder.parent().offset().top,
                    infoHolderHeight: this.holder.parent().height(),
                    mediaHolder: $('.qodef-media'),
                    mediaHolderHeight: $('.qodef-media').height(),
                    header: $('#qodef-page-header'),
                    headerHeight: $('#qodef-page-header').length ? $('#qodef-page-header').height() : 0,
                    constant: 30, //30 to prevent mispositioned
                    marginTop: 0
                };

                qodefPortfolio.infoHolderPosition(params);

                $(window).scroll(function () {
                    qodefPortfolio.recalculateInfoHolderPosition(params);
                });

            }

        },
        infoHolderPosition: function (params) {
            if (params.mediaHolderHeight >= params.infoHolderHeight) {
                if (qodef.scroll >= params.infoHolderOffset - params.headerHeight) {

                    params.marginTop = qodef.scroll - params.infoHolderOffset + params.headerHeight + params.constant;

                    // if scroll is initially positioned below mediaHolderHeight
                    if (params.marginTop + params.infoHolderHeight > params.mediaHolderHeight) {
                        params.marginTop = params.mediaHolderHeight - params.infoHolderHeight + params.constant;
                    }

                    params.self.stop().animate({
                        marginTop: params.marginTop
                    });
                }
            }
        },

        recalculateInfoHolderPosition: function (params) {
            // this is updated after scroll - for ie issue on starting height
            params.mediaHolderHeight = params.mediaHolder ? params.mediaHolder.height() : 0;
            if (params.mediaHolderHeight >= params.infoHolderHeight) {

                //Calculate header height if header appears
                if (qodef.scroll > 0) {
                    params.headerHeight = params.header.height();
                }

                var headerMixin = params.headerHeight + params.constant;

                if (qodef.scroll >= params.infoHolderOffset - headerMixin) {
                    if (qodef.scroll + params.infoHolderHeight + headerMixin + 2 * params.constant < params.infoHolderOffset + params.mediaHolderHeight) {
                        params.self.stop().animate({
                            marginTop: (qodef.scroll - params.infoHolderOffset + headerMixin + 2 * params.constant)
                        });

                        //Reset header height
                        params.headerHeight = 0;

                    } else {
                        params.self.stop().animate({
                            marginTop: params.mediaHolderHeight - params.infoHolderHeight
                        });
                    }
                } else {
                    params.self.stop().animate({
                        marginTop: 0
                    });
                }
            }
        },
    };
})(jQuery);


