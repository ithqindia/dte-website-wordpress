(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefWooSelect2.init();
        qodefWooQuantityButtons.init();
        qodefWooMagnificPopup.init();
    });

    var qodefWooSelect2 = {
        init: function (settings) {
            this.holder = [];
            this.holder.push({
                holder: $('#qodef-woo-page .woocommerce-ordering select'),
                options: {minimumResultsForSearch: Infinity},
                submit: false
            });
            this.holder.push({
                holder: $('#qodef-woo-page .variations select'),
                options: {},
                newLocation: false
            });
            this.holder.push({
                holder: $('#qodef-woo-page #calc_shipping_country'),
                options: {},
                newLocation: false
            });
            this.holder.push({
                holder: $('#qodef-woo-page .shipping select#calc_shipping_state'),
                options: {},
                newLocation: false
            });
            this.holder.push({
                holder: $('.widget.widget_archive select'),
                options: {},
                newLocation: true
            });
            this.holder.push({
                holder: $('.widget.widget_categories select'),
                options: {},
                newLocation: false
            });
            this.holder.push({
                holder: $('.widget.widget_text select'),
                options: {},
                newLocation: false
            });

            // Allow overriding the default config
            $.extend(this.holder, settings);

            if (typeof this.holder === 'object') {
                $.each(this.holder, function (key, value) {
                    qodefWooSelect2.createSelect2(value.holder, value.options, value.newLocation);
                });
            }
        },
        createSelect2: function (holder, options, newLocation) {
            if (typeof holder.select2 === 'function') {
                holder.select2(options);

                // console.log(options);

                if (newLocation === true) {
                    holder.on('select2:select', function (event) {
                        var url = event.params.data.id;
                        document.location.href = url;
                    });
                }
            }
        }
    };

    var qodefWooQuantityButtons = {
        init: function () {
            $(document).on('click', '.qodef-quantity-minus, .qodef-quantity-plus', function (e) {
                e.stopPropagation();

                var button = $(this),
                    inputField = button.siblings('.qodef-quantity-input'),
                    step = parseFloat(inputField.data('step')),
                    max = parseFloat(inputField.data('max')),
                    min = parseFloat(inputField.data('min')),
                    minus = false,
                    inputValue = parseFloat(inputField.val()),
                    newInputValue;

                if (button.hasClass('qodef-quantity-minus')) {
                    minus = true;
                }

                if (minus) {
                    newInputValue = inputValue - step;
                    if (newInputValue >= min) {
                        inputField.val(newInputValue);
                    } else {
                        inputField.val(min);
                    }
                } else {
                    newInputValue = inputValue + step;
                    if (max === undefined) {
                        inputField.val(newInputValue);
                    } else {
                        if (newInputValue >= max) {
                            inputField.val(max);
                        } else {
                            inputField.val(newInputValue);
                        }
                    }
                }

                inputField.trigger('change');
            });
        }
    };

    var qodefWooMagnificPopup = {
        init: function () {
            if (typeof qodef.qodefMagnificPopup === 'object') {
                var $holder = $('.qodef--single.qodef-magnific-popup.qodef-popup-gallery .woocommerce-product-gallery__image');

                if ($holder.length) {
                    $holder.each(function () {
                        $(this).children('a').attr('data-type', 'image').addClass('qodef-popup-item');
                    });

                    qodef.qodefMagnificPopup.init();
                }
            }
        }
    }

})(jQuery);
