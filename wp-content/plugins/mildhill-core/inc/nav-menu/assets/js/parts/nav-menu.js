(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefNavMenu.init();
        qodefNavMenu.wideDropdownPosition();
        qodefNavMenu.dropdownPosition();
        qodefNavMenu.bottomDotForMenu();
    });

    var qodefNavMenu = {
        wideDropdownPosition: function () {
            var menuItems = $(".qodef-header-navigation > ul > li.qodef-menu-item--wide");

            if (menuItems.length) {
                menuItems.each(function () {
                    var menuItem = $(this);
                    var menuItemSubMenu = menuItem.find('.qodef-drop-down-second');

                    if (menuItemSubMenu.length) {
                        menuItemSubMenu.css('left', 0);

                        var leftPosition = menuItemSubMenu.offset().left;

                        if (qodef.body.hasClass('qodef--boxed')) {
                            //boxed layout case
                            var boxedWidth = $('.qodef--boxed #qodef-page-wrapper').outerWidth();
                            leftPosition = leftPosition - (qodef.windowWidth - boxedWidth) / 2;
                            menuItemSubMenu.css({'left': -leftPosition, 'width': boxedWidth});

                        } else if (qodef.body.hasClass('qodef-drop-down-second--full-width')) {
                            //wide dropdown full width case
                            menuItemSubMenu.css({'left': -leftPosition});
                        }
                        else {
                            //wide dropdown in grid case
                            menuItemSubMenu.css({'left': -leftPosition + (qodef.windowWidth - menuItemSubMenu.width()) / 2});
                        }
                    }
                });
            }
        },
        dropdownPosition: function () {
            var $menuItems = $('.qodef-header-navigation > ul > li.qodef-menu-item--narrow.menu-item-has-children');

            if ($menuItems.length) {
                $menuItems.each(function () {
                    var thisItem = $(this),
                        menuItemPosition = thisItem.offset().left,
                        dropdownHolder = thisItem.find('.qodef-drop-down-second'),
                        dropdownMenuItem = dropdownHolder.find('.qodef-drop-down-second-inner ul'),
                        dropdownMenuWidth = dropdownMenuItem.outerWidth(),
                        menuItemFromLeft = $(window).width() - menuItemPosition;

                    var dropDownMenuFromLeft;

                    if (thisItem.find('li.menu-item-has-children').length > 0) {
                        dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
                    }

                    dropdownHolder.removeClass('qodef-drop-down--right');
                    dropdownMenuItem.removeClass('qodef-drop-down--right');
                    if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
                        dropdownHolder.addClass('qodef-drop-down--right');
                        dropdownMenuItem.addClass('qodef-drop-down--right');
                    }
                });
            }
        },
        bottomDotForMenu: function() {
            var firstLevelMenus = $('.qodef-header-navigation > ul');

            if (firstLevelMenus.length) {
                firstLevelMenus.each(function(){
                    var mainMenu = $(this);
    
                    mainMenu.append('<li class="qodef-main-menu-dot"></li>');
    
                    var menuDot = mainMenu.find('.qodef-main-menu-dot'),
                        menuItems = mainMenu.find('> li.menu-item'),
                        initialOffset;
    
                    if (menuItems.filter('.current-menu-ancestor').length) {
                        initialOffset = menuItems.filter('.current-menu-ancestor').offset().left;
                        menuDot.css('width', menuItems.filter('.current-menu-ancestor').outerWidth());
                        menuDot.css("color", menuItems.filter('.current-menu-ancestor').find('.qodef-menu-item-inner').css('color'));
                    } else {
                        initialOffset = menuItems.first().offset().left;
                        menuDot.css('width', menuItems.first().outerWidth());
                        menuDot.css("color", menuItems.first().find('.qodef-menu-item-inner').css('color'));
                    }
    
                    //initial positioning
                    menuDot.css('left',  initialOffset - mainMenu.offset().left);
    
                    //fx on    
                    menuItems.mouseenter(function(){
                        var menuItem = $(this),
                            menuItemWidth = menuItem.outerWidth(),
                            mainMenuOffset = mainMenu.offset().left,
                            menuItemOffset = menuItem.offset().left - mainMenuOffset;
                        
                        menuItems.removeClass('qodef-menu-item--hovered');
                        menuItem.addClass('qodef-menu-item--hovered');
                        menuDot.css('width', menuItemWidth);
                        menuDot.css('left', menuItemOffset);
                        setTimeout(function() {
                            menuDot.css("color", menuItem.find('.qodef-menu-item-inner').css('color'));
                        }, 100);
                    });
    
                    //fx off    
                    mainMenu.mouseleave(function(){
                        if (menuItems.filter('.current-menu-ancestor').length) {
                            menuDot.css('width', menuItems.filter('.current-menu-ancestor').outerWidth());
                            setTimeout(function() {
                                menuDot.css("color",  menuItems.filter('.current-menu-ancestor').find('.qodef-menu-item-inner').css('color'));
                            }, 100);
                        } else {
                            menuDot.css('width', menuItems.first().outerWidth());
                            setTimeout(function() {
                                menuDot.css("color", menuItems.first().find('.qodef-menu-item-inner').css('color'));
                            }, 100);
                        }
                        
                        menuItems.removeClass('qodef-menu-item--hovered');
                        menuDot.css('left', initialOffset - mainMenu.offset().left);
                    });
    
                });
            }
        },
        init: function () {
            var $menuItems = $('.qodef-header-navigation > ul > li');

            $menuItems.each(function () {
                var thisItem = $(this);

                if (thisItem.find('.qodef-drop-down-second').length) {
                    thisItem.waitForImages(function () {
                        var dropDownHolder = thisItem.find('.qodef-drop-down-second'),
                            dropDownHolderHeight = !qodef.menuDropdownHeightSet ? dropDownHolder.outerHeight() : 0;

                        if (!qodef.menuDropdownHeightSet) {
                            dropDownHolder.height(0);
                        }

                        if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                            thisItem.on("touchstart mouseenter", function () {
                                dropDownHolder.css({
                                    'height': dropDownHolderHeight,
                                    'overflow': 'visible',
                                    'visibility': 'visible',
                                    'opacity': '1'
                                });
                            }).on("mouseleave", function () {
                                dropDownHolder.css({
                                    'height': '0px',
                                    'overflow': 'hidden',
                                    'visibility': 'hidden',
                                    'opacity': '0'
                                });
                            });
                        } else {
                            var animateConfig = {
                                interval: 0,
                                over: function () {
                                    dropDownHolder.addClass('qodef-drop-down--start');
                                },
                                timeout: 50,
                                out: function () {
                                    dropDownHolder.removeClass('qodef-drop-down--start');
                                }
                            };

                            dropDownHolder.css({'height': dropDownHolderHeight});
                            thisItem.hoverIntent(animateConfig);
                        }
                    });
                }
            });
        }
    };

})(jQuery);
