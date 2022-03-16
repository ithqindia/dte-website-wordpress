(function ($) {
    "use strict";

    window.qodefCore = {};

    $(document).ready(function () {
        qodefInlinePageStyle.init();
    });

    var qodefScroll = {
        disable: function () {
            if (window.addEventListener) {
                window.addEventListener('wheel', qodefScroll.preventDefaultValue, {passive: false});
            }

            // window.onmousewheel = document.onmousewheel = qodefScroll.preventDefaultValue;
            document.onkeydown = qodefScroll.keyDown;
        },
        enable: function () {
            if (window.removeEventListener) {
                window.removeEventListener('wheel', qodefScroll.preventDefaultValue, {passive: false});
            }
            window.onmousewheel = document.onmousewheel = document.onkeydown = null;
        },
        preventDefaultValue: function (e) {
            e = e || window.event;
            if (e.preventDefault) {
                e.preventDefault();
            }
            e.returnValue = false;
        },
        keyDown: function (e) {
            var keys = [37, 38, 39, 40];
            for (var i = keys.length; i--;) {
                if (e.keyCode === keys[i]) {
                    qodefScroll.preventDefaultValue(e);
                    return;
                }
            }
        }
    };

    qodefCore.qodefScroll = qodefScroll;

    var qodefPerfectScrollbar = {
        init: function (holder) {
            if (holder.length) {
                qodefPerfectScrollbar.qodefInitScroll(holder);
            }
        },
        qodefInitScroll: function (holder) {
            var $defaultParams = {
                wheelSpeed: 0.6,
                suppressScrollX: true
            };

            var ps = new PerfectScrollbar(holder.selector, $defaultParams);
            $(window).resize(function () {
                ps.update();
            });
        }
    };

    qodefCore.qodefPerfectScrollbar = qodefPerfectScrollbar;

    var qodefInlinePageStyle = {
        init: function () {
            this.holder = $('#mildhill-core-page-inline-style');

            if (this.holder.length) {
                var style = this.holder.data('style');

                if (style.length) {
                    $('head').append('<style type="text/css">' + style + '</style>');
                }
            }
        }
    };

})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefBackToTop.init();
	});
	
	var qodefBackToTop = {
		init: function () {
			this.holder = $('#qodef-back-to-top');
			
			// Scroll To Top
			this.holder.on('click', function (e) {
				e.preventDefault();
				
				$('html, body').animate({scrollTop: 0}, $(window).scrollTop() / 4, 'swing');
			});
			
			qodefBackToTop.showHideBackToTop();
		},
		showHideBackToTop: function () {
			$(window).scroll(function () {
				var b = $(this).scrollTop(),
					c = $(this).height(),
					d;
				
				if (b > 0) {
					d = b + c / 2;
				} else {
					d = 1;
				}
				
				if (d < 1e3) {
					qodefBackToTop.addClass('off');
				} else {
					qodefBackToTop.addClass('on');
				}
			});
		},
		addClass: function (a) {
			this.holder.removeClass('qodef-back-to-top--off qodef-back-to-top--on');
			
			if (a === 'on') {
				this.holder.addClass('qodef-back-to-top--on');
			} else {
				this.holder.addClass('qodef-back-to-top--off');
			}
		}
	};
	
})(jQuery);

(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefFullscreenMenu.init();
	});
	
	var qodefFullscreenMenu = {
		init: function () {
			var $fullscreenMenuOpener = $('a.qodef-fullscreen-menu-opener'),
				$menuItems = $('.qodef-fullscreen-menu-holder nav ul li a');
			
			// Open popup menu
			$fullscreenMenuOpener.on('click', function (e) {
				e.preventDefault();
				
				if (!qodef.body.hasClass('qodef-fullscreen-menu--opened')) {
					qodefFullscreenMenu.openFullscreen();
					$(document).keyup(function (e) {
						if (e.keyCode === 27) {
							qodefFullscreenMenu.closeFullscreen();
						}
					});
				} else {
					qodefFullscreenMenu.closeFullscreen();
				}
			});
			
			//open dropdowns
			$menuItems.on('tap click', function (e) {
				var $thisItem = $(this);
				if ($thisItem.parent().hasClass('menu-item-has-children')) {
					e.preventDefault();
					qodefFullscreenMenu.clickItemWithChild($thisItem);
				} else if (($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")) {
					qodefFullscreenMenu.closeFullscreen();
				}
			});
		},
		openFullscreen: function () {
			qodef.body.removeClass('qodef-fullscreen-menu-animate--out').addClass('qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in');
			qodefCore.qodefScroll.disable();
		},
		closeFullscreen: function () {
			qodef.body.removeClass('qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in').addClass('qodef-fullscreen-menu-animate--out');
			qodefCore.qodefScroll.enable();
			$("nav.qodef-fullscreen-menu ul.sub_menu").slideUp(200);
		},
		clickItemWithChild: function (thisItem) {
			var $thisItemParent = thisItem.parent(),
				$thisItemSubMenu = $thisItemParent.find('.sub-menu').first();
			
			if ($thisItemSubMenu.is(':visible')) {
				$thisItemSubMenu.slideUp(300);
			} else {
				$thisItemSubMenu.slideDown(300);
				$thisItemParent.siblings().find('.sub-menu').slideUp(400);
			}
		}
	};
	
})(jQuery);

(function($){
    "use strict";

    $(document).ready(function () {
        qodefHeaderScrollAppearance.init();
    });

    var qodefHeaderScrollAppearance = {
        appearanceType: function() {
            return qodef.body.attr('class').indexOf('qodef-header-appearance--') !== -1 ? qodef.body.attr('class').match(/qodef-header-appearance--([\w]+)/)[1] : '';
        },
        init: function(){
            var appearanceType = this.appearanceType();

            if(appearanceType !== '' && appearanceType !== 'none'){
                window["qodef"][appearanceType+"HeaderAppearance"]();
            }
        }
    };

})(jQuery);

(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefMobileHeaderAppearance.init();
    });

    /*
     **	Init mobile header functionality
     */
    var qodefMobileHeaderAppearance = {
        init: function () {
            if (qodef.body.hasClass('qodef-mobile-header-appearance--sticky')) {

                var docYScroll1 = qodef.scroll,
                    displayAmount = qodefGlobal.vars.mobileHeaderHeight + qodefGlobal.vars.adminBarHeight,
                    $pageOuter = $('#qodef-page-outer');

                qodefMobileHeaderAppearance.showHideMobileHeader(docYScroll1, displayAmount, $pageOuter);
                $(window).scroll(function () {
                    qodefMobileHeaderAppearance.showHideMobileHeader(docYScroll1, displayAmount, $pageOuter);
                    docYScroll1 = qodef.scroll;
                });

                $(window).resize(function () {
                    $pageOuter.css('padding-top', 0);
                    qodefMobileHeaderAppearance.showHideMobileHeader(docYScroll1, displayAmount, $pageOuter);
                });
            }
        },
        showHideMobileHeader: function(docYScroll1, displayAmount,$pageOuter){
            if(qodef.windowWidth <= 1024) {
                if (qodef.scroll > displayAmount * 2) {
                    //set header to be fixed
                    qodef.body.addClass('qodef-mobile-header--sticky');

                    //add transition to it
                    setTimeout(function () {
                        qodef.body.addClass('qodef-mobile-header--sticky-animation');
                    }, 300); //300 is duration of sticky header animation

                    //add padding to content so there is no 'jumping'
                    $pageOuter.css('padding-top', qodefGlobal.vars.mobileHeaderHeight);
                } else {
                    //unset fixed header
                    qodef.body.removeClass('qodef-mobile-header--sticky');

                    //remove transition
                    setTimeout(function () {
                        qodef.body.removeClass('qodef-mobile-header--sticky-animation');
                    }, 300); //300 is duration of sticky header animation

                    //remove padding from content since header is not fixed anymore
                    $pageOuter.css('padding-top', 0);
                }

                if ((qodef.scroll > docYScroll1 && qodef.scroll > displayAmount) || (qodef.scroll < displayAmount * 3)) {
                    //show sticky header
                    qodef.body.removeClass('qodef-mobile-header--sticky-display');
                } else {
                    //hide sticky header
                    qodef.body.addClass('qodef-mobile-header--sticky-display');
                }
            }
        }
    };

})(jQuery);
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

(function ($) {
    "use strict";

    $(window).on('load',function () {
        qodefParallaxBackground.init();
    });

    /**
     * Init global parallax background functionality
     */
    var qodefParallaxBackground = {
        init: function (settings) {
            this.$sections = $('.qodef-parallax');

            // Allow overriding the default config
            $.extend(this.$sections, settings);

            var isSupported = !qodef.html.hasClass('touchevents') && !qodef.body.hasClass('qodef-browser--edge') && !qodef.body.hasClass('qodef-browser--ms-explorer');

            if (this.$sections.length && isSupported) {
                this.$sections.each(function () {
                    qodefParallaxBackground.ready($(this));
                });
            }
        },
        ready: function ($section) {
            $section.$imgHolder = $section.find('.qodef-parallax-img-holder');
            $section.$imgWrapper = $section.find('.qodef-parallax-img-wrapper');
            $section.$img = $section.find('img');

            var h = $section.height(),
                imgWrapperH = $section.$imgWrapper.height();

            $section.movement = 100 * (imgWrapperH - h) / h / 2; //percentage (divided by 2 due to absolute img centering in CSS)

            $section.buffer = window.pageYOffset;
            $section.scrollBuffer = null;


            //calc and init loop
            requestAnimationFrame(function () {
                $section.$imgHolder.animate({opacity: 1}, 100);
                qodefParallaxBackground.calc($section);
                qodefParallaxBackground.loop($section);
            });

            //recalc
            $(window).on('resize', function () {
                qodefParallaxBackground.calc($section);
            });
        },
        calc: function ($section) {
            var wH = $section.$imgWrapper.height(),
                wW = $section.$imgWrapper.width();

            if ($section.$img.width() < wW) {
                $section.$img.css({
                    'width': '100%',
                    'height': 'auto'
                });
            }

            if ($section.$img.height() < wH) {
                $section.$img.css({
                    'height': '100%',
                    'width': 'auto',
                    'max-width': 'unset'
                });
            }
        },
        loop: function ($section) {
            if ($section.scrollBuffer === Math.round(window.pageYOffset)) {
                requestAnimationFrame(function () {
                    qodefParallaxBackground.loop($section);
                }); //repeat loop
                return false; //same scroll value, do nothing
            } else {
                $section.scrollBuffer = Math.round(window.pageYOffset);
            }

            var wH = window.outerHeight,
                sTop = $section.offset().top,
                sH = $section.height();

            if ($section.scrollBuffer + wH * 1.2 > sTop && $section.scrollBuffer < sTop + sH) {
                var delta = (Math.abs($section.scrollBuffer + wH - sTop) / (wH + sH)).toFixed(4), //coeff between 0 and 1 based on scroll amount
                    yVal = (delta * $section.movement).toFixed(4);

                if ($section.buffer !== delta) {
                    $section.$imgWrapper.css('transform', 'translate3d(0,' + yVal + '%, 0)');
                }

                $section.buffer = delta;
            }

            requestAnimationFrame(function () {
                qodefParallaxBackground.loop($section);
            }); //repeat loop
        }
    };

})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefSideArea.init();
    });

    var qodefSideArea = {
        init: function () {
            var $sideAreaOpener = $('a.qodef-side-area-opener'),
                $sideAreaClose = $('#qodef-side-area-close'),
                $sideArea = $('#qodef-side-area');

            qodef.body.prepend('<div class="qodef-side-area-cover"/>');

            // Open Side Area
            $sideAreaOpener.on('click', function (e) {
                e.preventDefault();

                if (!qodef.body.hasClass('qodef-side-area--opened')) {
                    qodefSideArea.openSideArea();

                    $(document).keyup(function (e) {
                        if (e.keyCode === 27) {
                            qodefSideArea.closeSideArea();
                        }
                    });
                } else {
                    qodefSideArea.closeSideArea();
                }
            });

            $sideAreaClose.on('click', function (e) {
                e.preventDefault();
                qodefSideArea.closeSideArea();
            });

            if ($sideArea.length && typeof window.qodefCore.qodefPerfectScrollbar === 'object') {
                window.qodefCore.qodefPerfectScrollbar.init($sideArea);
            }
        },
        openSideArea: function () {
            var $wrapper = $('#qodef-page-wrapper'),
                currentScroll = $(window).scrollTop();
            
            qodef.body.removeClass('qodef-side-area-animate--out').addClass('qodef-side-area--opened qodef-side-area-animate--in');

            $('.qodef-side-area-cover').on('click', function (e) {
                e.preventDefault();
                qodefSideArea.closeSideArea();
            });

            $(window).scroll(function () {
                if (Math.abs(qodef.scroll - currentScroll) > 400) {
                    qodefSideArea.closeSideArea();
                }
            });

        },
        closeSideArea: function () {
            qodef.body.removeClass('qodef-side-area--opened qodef-side-area-animate--in').addClass('qodef-side-area-animate--out');
        },
    };

})(jQuery);

(function ($) {
	"use strict";
	
	$(document).ready(function () {
		spinners.init();
	});
	
	var spinners = {
		init: function () {
			
			if ($('.qodef-smooth-transition-loader').length) {
				spinners.animateSpinners();
			}
			
		},
		animateSpinners: function () {
			//check for preload animation
			var loader = $('.qodef-smooth-transition-loader'),
				mainRevHolder = $('#qodef-main-rev-holder'),
				mildhillSpinner = $('.qodef-mildhill-spinner-holder');

			if (mildhillSpinner.length) {
				loader.addClass('qodef-mildhill-loader');

				setTimeout(function() {
					loader.addClass('qodef-mildhill-loader--ready');
				}, 400);

				var numberHolder = mildhillSpinner.find('.qodef-mildhill-spinner-number'),
					percentNumber = 0,
					numberIntervalFastest,
					windowLoaded = false;

				var animatePercent = function() {
					if(percentNumber < 100) {
						percentNumber+=1;
						numberHolder.text(percentNumber);
					}
				}
					
				var numberInterval = setInterval(function() {
					animatePercent();
					if(windowLoaded) {
						clearInterval(numberInterval);
					}
				}, 100);

				$(window).on('load', function() {
					windowLoaded = true;
					numberIntervalFastest = setInterval(function() {
						if(percentNumber >= 100) {
							clearInterval(numberIntervalFastest);
							setTimeout(function(){
								loader.addClass('qodef-mildhill-loader--finished');
								setTimeout(function() {
									fadeOutLoader();
								}, 900);
								setTimeout(function() {
									mainRevHolder.find('rs-module').revstart();
								}, 1000);
							}, 700);
						} else {
							animatePercent();
						}
					}, 6);
				});
			} else {
				$(window).on('load', function() {
					fadeOutLoader();
				});
			}

			/**
			 * Loader Fade Out function
			 *
			 * @param {number} speed - fade out duration
			 * @param {number} delay - fade out delay
			 * @param {string} easing - fade out easing function
			 */
			var fadeOutLoader = function(speed, delay, easing) {
				speed = speed ? speed : 600;
				delay = delay ? delay : 0;
				easing = easing ? easing : 'swing';

				loader.delay(delay).fadeOut(speed, easing);
				$(window).on('bind', 'pageshow', function (event) {
					if (event.originalEvent.persisted) {
						loader.fadeOut(speed, easing);
					}
				});
			};
		},
	};
	
})(jQuery);

(function ($) {
    "use strict";

    $(window).on('load',function () {
        qodefSubscribeModal.init();
    });

    var qodefSubscribeModal = {
        init: function () {
            this.holder = $('#qodef-subscribe-popup-modal');

            if (this.holder.length) {
                var $preventHolder = this.holder.find('.qodef-sp-prevent'),
                    $modalClose = $('#qodef-sp-close, .qodef-sp-overlay-cover'),
                    disabledPopup = 'no';

                if ($preventHolder.length) {
                    var isLocalStorage = this.holder.hasClass('qodef-sp-prevent-cookies'),
                        $preventInput = $preventHolder.find('.qodef-sp-prevent-input'),
                        preventValue = $preventInput.data('value');

                    if (isLocalStorage) {
                        disabledPopup = localStorage.getItem('disabledPopup');
                        sessionStorage.removeItem('disabledPopup');
                    } else {
                        disabledPopup = sessionStorage.getItem('disabledPopup');
                        localStorage.removeItem('disabledPopup');
                    }

                    $preventHolder.children().on('click', function (e) {
                        if (preventValue !== 'yes') {
                            preventValue = 'yes';
                            $preventInput.addClass('qodef-sp-prevent-clicked').data('value', 'yes');
                        } else {
                            preventValue = 'no';
                            $preventInput.removeClass('qodef-sp-prevent-clicked').data('value', 'no');
                        }

                        if (preventValue === 'yes') {
                            if (isLocalStorage) {
                                localStorage.setItem('disabledPopup', 'yes');
                            } else {
                                sessionStorage.setItem('disabledPopup', 'yes');
                            }
                        } else {
                            if (isLocalStorage) {
                                localStorage.setItem('disabledPopup', 'no');
                            } else {
                                sessionStorage.setItem('disabledPopup', 'no');
                            }
                        }
                    });
                }

                if (disabledPopup !== 'yes') {
                    if (qodef.body.hasClass('qodef-sp-opened')) {
                        qodefSubscribeModal.handleClassAndScroll('remove');
                    } else {
                        qodefSubscribeModal.handleClassAndScroll('add');
                    }

                    $modalClose.on('click', function (e) {
                        e.preventDefault();
                        qodefSubscribeModal.handleClassAndScroll('remove');
                    });

                    // Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode === 27) { // KeyCode for ESC button is 27
                            qodefSubscribeModal.handleClassAndScroll('remove');
                        }
                    });
                }
            }
        },

        handleClassAndScroll: function (option) {
            if (option === 'remove') {
                qodef.body.removeClass('qodef-sp-opened');
                qodefCore.qodefScroll.enable();
            }
            if (option === 'add') {
                qodef.body.addClass('qodef-sp-opened');
                qodefCore.qodefScroll.disable();
            }
        },
    };

})(jQuery);
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



(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefAccordion.init();
	});
	
	var qodefAccordion = {
		init: function () {
			this.holder = $('.qodef-accordion');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);
					
					if ($thisHolder.hasClass('qodef-behavior--accordion')) {
						qodefAccordion.initAccordion($thisHolder);
					}
					
					if ($thisHolder.hasClass('qodef-behavior--toggle')) {
						qodefAccordion.initToggle($thisHolder);
					}
					
					$thisHolder.addClass('qodef--init');
				});
			}
		},
		initAccordion: function (accordion) {
			accordion.accordion({
				animate: "swing",
				collapsible: true,
				active: 0,
				icons: "",
				heightStyle: "content"
			});
		},
		initToggle: function (toggle) {
			var $toggleAccordionTitle = toggle.find('.qodef-accordion-title'),
				$toggleAccordionContent = $toggleAccordionTitle.next();
			
			toggle.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
			$toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
			$toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();
			
			$toggleAccordionTitle.each(function () {
				var $thisTitle = $(this);
				
				$thisTitle.hover(function () {
					$thisTitle.toggleClass("ui-state-hover");
				});
				
				$thisTitle.on('click', function () {
					$thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
					$thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
				});
			});
		}
	};
	
})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefButton.init();
	});
	
	var qodefButton = {
		init: function () {
			this.buttons = $('.qodef-button');
			
			if (this.buttons.length) {
				this.buttons.each(function () {
					var $thisButton = $(this);
					
					qodefButton.buttonHoverColor($thisButton);
					qodefButton.buttonHoverBgColor($thisButton);
					qodefButton.buttonHoverBorderColor($thisButton);
				});
			}
		},
		buttonHoverColor: function (button) {
			if (typeof button.data('hover-color') !== 'undefined') {
				var hoverColor = button.data('hover-color');
				var originalColor = button.css('color');
				
				button.on('mouseenter', function () {
					qodefButton.changeColor(button, 'color', hoverColor);
				});
				button.on('mouseleave', function () {
					qodefButton.changeColor(button, 'color', originalColor);
				});
			}
		},
		buttonHoverBgColor: function (button) {
			if (typeof button.data('hover-background-color') !== 'undefined') {
				var hoverBackgroundColor = button.data('hover-background-color');
				var originalBackgroundColor = button.css('background-color');
				
				button.on('mouseenter', function () {
					qodefButton.changeColor(button, 'background-color', hoverBackgroundColor);
				});
				button.on('mouseleave', function () {
					qodefButton.changeColor(button, 'background-color', originalBackgroundColor);
				});
			}
		},
		buttonHoverBorderColor: function (button) {
			if (typeof button.data('hover-border-color') !== 'undefined') {
				var hoverBorderColor = button.data('hover-border-color');
				var originalBorderColor = button.css('borderTopColor');
				
				button.on('mouseenter', function () {
					qodefButton.changeColor(button, 'border-color', hoverBorderColor);
				});
				button.on('mouseleave', function () {
					qodefButton.changeColor(button, 'border-color', originalBorderColor);
				});
			}
		},
		changeColor: function (button, cssProperty, color) {
			button.css(cssProperty, color);
		}
	};
	
})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefCountdown.init();
	});
	
	var qodefCountdown = {
		init: function () {
			this.countdowns = $('.qodef-countdown');
			
			if (this.countdowns.length) {
				this.countdowns.each(function () {
					var $thisCountdown = $(this),
						countdownElement = $thisCountdown.find('.qodef-m-date'),
						options = qodefCountdown.generateOptions($thisCountdown);
					qodefCountdown.initCountdown(countdownElement, options);
				});
			}
		},
		generateOptions: function(countdown) {
			var options = {};
			options.date = countdown.data('date') !== undefined ? countdown.data('date') : null;
			
			options.weekLabel = countdown.data('week-label') !== undefined ? countdown.data('week-label') : '';
			options.weekLabelPlural = countdown.data('week-label-plural') !== undefined ? countdown.data('week-label-plural') : '';
			
			options.dayLabel = countdown.data('day-label') !== undefined ? countdown.data('day-label') : '';
			options.dayLabelPlural = countdown.data('day-label-plural') !== undefined ? countdown.data('day-label-plural') : '';
			
			options.hourLabel = countdown.data('hour-label') !== undefined ? countdown.data('hour-label') : '';
			options.hourLabelPlural = countdown.data('hour-label-plural') !== undefined ? countdown.data('hour-label-plural') : '';
			
			options.minuteLabel = countdown.data('minute-label') !== undefined ? countdown.data('minute-label') : '';
			options.minuteLabelPlural = countdown.data('minute-label-plural') !== undefined ? countdown.data('minute-label-plural') : '';
			
			options.secondLabel = countdown.data('second-label') !== undefined ? countdown.data('second-label') : '';
			options.secondLabelPlural = countdown.data('second-label-plural') !== undefined ? countdown.data('second-label-plural') : '';
			
			return options;
			
		},
		initCountdown: function (countdownElement, options) {
			countdownElement.countdown(options.date, function(event) {
				$(this).html(event.strftime(''
					+ '<span class="qodef-digit-wrapper"><span class="qodef-digit">%w</span><span class="qodef-label">' + '%!w:' + options.weekLabel + ',' + options.weekLabelPlural + ';</span></span>'
					+ '<span class="qodef-digit-wrapper"><span class="qodef-digit">%d</span><span class="qodef-label">' + '%!d:' + options.dayLabel + ',' + options.dayLabelPlural + ';</span></span>'
					+ '<span class="qodef-digit-wrapper"><span class="qodef-digit">%H</span><span class="qodef-label">' + '%!H:' + options.hourLabel + ',' + options.hourLabelPlural + ';</span></span>'
					+ '<span class="qodef-digit-wrapper"><span class="qodef-digit">%M</span><span class="qodef-label">' + '%!M:' + options.minuteLabel + ',' + options.minuteLabelPlural + ';</span></span>'
					+ '<span class="qodef-digit-wrapper"><span class="qodef-digit">%S</span><span class="qodef-label">' + '%!S:' + options.secondLabel + ',' + options.secondLabelPlural + ';</span></span>'
				));
			});
		}
	};
	
})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefCounter.init();
	});
	
	var qodefCounter = {
		init: function () {
			this.counters = $('.qodef-counter');
			
			if (this.counters.length) {
				this.counters.each(function () {
					var $thisCounter = $(this),
						counterElement = $thisCounter.find('.qodef-m-digit'),
						options = qodefCounter.generateOptions($thisCounter);
					qodefCounter.counterScript(counterElement, options);
				});
			}
		},
		generateOptions: function(counter) {
			var options = {};
			options.start = counter.data('start-digit') !== undefined ? counter.data('start-digit') : 0;
			options.end = counter.data('end-digit') !== undefined ? counter.data('end-digit') : null;
			options.step = counter.data('step-digit') !== undefined ? counter.data('step-digit') : 1;
			options.delay = counter.data('step-delay') !== undefined ? counter.data('step-delay') : 100;
			options.txt = counter.data('digit-label') !== undefined ? counter.data('digit-label') : '';
			
			return options;
		},
		counterScript: function (counterElement, options) {
			var defaults = {
				start: 0,
				end: null,
				step: 1,
				delay: 100,
				txt: ""
			};
			
			var settings = $.extend(defaults, options || {});
			var nb_start = settings.start;
			var nb_end = settings.end;
			
			counterElement.text(nb_start + settings.txt);
			
			var counter = function() {
				// Definition of conditions of arrest
				if (nb_end !== null && nb_start >= nb_end) {
					return;
				}
				// incrementation
				nb_start = nb_start + settings.step;
				
				if( nb_start >= nb_end ) {
					nb_start = nb_end;
				}
				// display
				counterElement.text(nb_start + settings.txt);
			};
			
			// Timer
			// Launches every "settings.delay"
			setInterval(counter, settings.delay);
		}
	};
	
})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefGoogleMap.init();
	});
	
	var qodefGoogleMap = {
		init: function () {
			this.holder = $('.qodef-google-map');
			
			if (this.holder.length) {
				this.holder.each(function () {
					if (qodefCore.qodefGoogleMap !== undefined) {
						qodefCore.qodefGoogleMap.initMap($(this).find('.qodef-m-map'));
					}
				});
			}
		}
	};
	
})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefIcon.init();
    });

    var qodefIcon = {
        init: function () {
            this.icons = $('.qodef-icon-holder');

            if (this.icons.length) {
                this.icons.each(function () {
                    var $thisIcon = $(this);

                    qodefIcon.iconHoverColor($thisIcon);
                    qodefIcon.iconHoverBgColor($thisIcon);
                    qodefIcon.iconHoverBorderColor($thisIcon);
                });
            }
        },
        iconHoverColor: function (iconHolder) {
            if (typeof iconHolder.data('hover-color') !== 'undefined') {

                var spanHolder = iconHolder.find('span');
                var originalColor = spanHolder.css('color');
                var hoverColor = iconHolder.data('hover-color');

                iconHolder.on('mouseenter', function () {
                    qodefIcon.changeColor(spanHolder, 'color', hoverColor);
                });
                iconHolder.on('mouseleave', function () {
                    qodefIcon.changeColor(spanHolder, 'color', originalColor);
                });
            }
        },
        iconHoverBgColor: function (iconHolder) {
            if (typeof iconHolder.data('hover-background-color') !== 'undefined') {
                var hoverBackgroundColor = iconHolder.data('hover-background-color');
                var originalBackgroundColor = iconHolder.css('background-color');

                iconHolder.on('mouseenter', function () {
                    qodefIcon.changeColor(iconHolder, 'background-color', hoverBackgroundColor);
                });
                iconHolder.on('mouseleave', function () {
                    qodefIcon.changeColor(iconHolder, 'background-color', originalBackgroundColor);
                });
            }
        },
        iconHoverBorderColor: function (iconHolder) {
            if (typeof iconHolder.data('hover-border-color') !== 'undefined') {
                var hoverBorderColor = iconHolder.data('hover-border-color');
                var originalBorderColor = iconHolder.css('borderTopColor');

                iconHolder.on('mouseenter', function () {
                    qodefIcon.changeColor(iconHolder, 'border-color', hoverBorderColor);
                });
                iconHolder.on('mouseleave', function () {
                    qodefIcon.changeColor(iconHolder, 'border-color', originalBorderColor);
                });
            }
        },
        changeColor: function (iconElement, cssProperty, color) {
            iconElement.css(cssProperty, color);
        }
    };

    qodefCore.qodefIcon = qodefIcon;

})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefProgressBar.init();
    });

    var qodefProgressBar = {
        init: function () {
            this.holder = $('.qodef-progress-bar');

            if (this.holder.length) {
                this.holder.each(function () {
                    var $thisHolder = $(this),
                        layout = $thisHolder.data('layout'),
                        data = qodefProgressBar.generateBarData($thisHolder, layout),
                        container = '#qodef-m-canvas-' + $thisHolder.data('rand-number'),
                        number = $thisHolder.data('number') / 100;

                    switch (layout) {
                        case 'circle':
                            qodefProgressBar.initCircleBar($thisHolder, container, data, number);
                            break;
                        case 'semi-circle':
                            qodefProgressBar.initSemiCircleBar($thisHolder, container, data, number);
                            break;
                        case 'line':
                            number = $thisHolder.data('number');
                            container = $thisHolder.find('.qodef-m-canvas');
                            data = qodefProgressBar.generateLineData($thisHolder, layout, number);
                            qodefProgressBar.initLineBar($thisHolder, container, data);
                            break;
                    }
                });
            }
        },
        generateBarData: function (thisBar, layout) {
            var activeWidth = thisBar.data('active-line-width');
            var activeColor = thisBar.data('active-line-color');
            var inactiveWidth = thisBar.data('inactive-line-width');
            var inactiveColor = thisBar.data('inactive-line-color');
            var easing = 'linear';
            var duration = 1400;
            var textColor = thisBar.data('text-color');

            return {
                strokeWidth: activeWidth,
                color: activeColor,
                trailWidth: inactiveWidth,
                trailColor: inactiveColor,
                easing: easing,
                duration: duration,
                svgStyle: {width: '100%', height: '100%'},
                text: {
                    style: {
                        color: textColor
                    },
                    autoStyleContainer: false
                },
                from: {color: inactiveColor},
                to: {color: activeColor},
                step: function (state, bar) {
                    if (layout !== 'custom') {
                        bar.setText(Math.round(bar.value() * 100) + '%');
                    }
                }
            };
        },
        initCircleBar: function (holder, container, data, number) {
            var bar = new ProgressBar.Circle(container, data);
            holder.appear(function () {
                bar.animate(number);
            });
        },
        initSemiCircleBar: function (holder, container, data, number) {
            var bar = new ProgressBar.SemiCircle(container, data);
            holder.appear(function () {
                bar.animate(number);
            });
        },
        generateLineData: function (thisBar, layout, number) {
            var height = thisBar.data('active-line-width');
            var activeColor = thisBar.data('active-line-color');
            var inactiveHeight = thisBar.data('inactive-line-width');
            var inactiveColor = thisBar.data('inactive-line-color');
            var duration = 1400;
            var textColor = thisBar.data('text-color');

            return {
                percentage: number,
                duration: duration,
                fillBackgroundColor: activeColor,
                backgroundColor: inactiveColor,
                height: height,
                inactiveHeight: inactiveHeight,
                followText: false,
                textColor: textColor
            };
        },
        initLineBar: function (holder, container, data) {
            holder.appear(function () {
                container.LineProgressbar(data);
            });
        }
    };

})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefTabs.init();
	});
	
	var qodefTabs = {
		init: function () {
			this.holder = $('.qodef-tabs');
			
			if (this.holder.length) {
				this.holder.each(function () {
					qodefTabs.initTabs($(this));
				});
			}
		},
		initTabs: function (tabs) {
			tabs.children('.qodef-tabs-content').each(function (index) {
				index = index + 1;
				
				var $that = $(this),
					link = $that.attr('id'),
					$navItem = $that.parent().find('.qodef-tabs-navigation li:nth-child(' + index + ') a'),
					navLink = $navItem.attr('href');
				
				link = '#' + link;
				
				if (link.indexOf(navLink) > -1) {
					$navItem.attr('href', link);
				}
			});
			
			tabs.addClass('qodef--init').tabs();
		}
	};
	
})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefVerticalSplitSlider.init();
    });

    var qodefVerticalSplitSlider = {
        init: function () {
            var $holder = $('.qodef-vss'),
                breakpoint = qodefVerticalSplitSlider.getBreakpoint($holder),
                initialHeaderStyle = '';

            if (qodef.body.hasClass('qodef-header--light')) {
                initialHeaderStyle = 'light';
            } else if (qodef.body.hasClass('qodef-header--dark')) {
                initialHeaderStyle = 'dark';
            }

            if ($holder.length) {
                $holder.multiscroll({
                    navigation: true,
                    navigationPosition: 'right',
                    easing: 'swing',
                    afterRender: function () {
                        qodef.body.addClass('qodef-vss--initialized');
                        qodefVerticalSplitSlider.bodyClassHandler($('.ms-left .ms-section:first-child').data('header-skin'), initialHeaderStyle);
                    },
                    onLeave: function (index, nextIndex) {
                        qodefVerticalSplitSlider.bodyClassHandler($($('.ms-left .ms-section')[nextIndex - 1]).data('header-skin'), initialHeaderStyle);
                    }
                });

                $holder.height(qodef.windowHeight);
                qodefVerticalSplitSlider.buildAndDestroy(breakpoint);

                $(window).resize(function () {
                    qodefVerticalSplitSlider.buildAndDestroy(breakpoint);
                });
            }
        },
        getBreakpoint: function ($holder) {
            if ($holder.hasClass('qodef-vss--disable-below-768')) {
                return 768;
            } else {
                return 1024;
            }
        },
        buildAndDestroy: function (breakpoint) {
            if (qodef.windowWidth <= breakpoint) {
                $.fn.multiscroll.destroy();
                $('html, body').css('overflow', 'initial');
                qodef.body.removeClass('qodef-vss--initialized');
            } else {
                $.fn.multiscroll.build();
                qodef.body.addClass('qodef-vss--initialized');
            }
        },
        bodyClassHandler: function (slideHeaderStyle, initialHeaderStyle) {
            if (slideHeaderStyle !== undefined && slideHeaderStyle !== '') {
                qodef.body.removeClass('qodef-header--light qodef-header--dark').addClass('qodef-header--' + slideHeaderStyle);
            } else if (initialHeaderStyle !== '') {
                qodef.body.removeClass('qodef-header--light qodef-header--dark').addClass('qodef-header--' + slideHeaderStyle);
            } else {
                qodef.body.removeClass('qodef-header--light qodef-header--dark');
            }
        }
    }

})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefWorkflow.init();
	});
	
	var qodefWorkflow = {
		init: function () {
			this.holder = $('.qodef-workflow');
			
			if (this.holder.length) {
				this.holder.each(function () {
					qodefWorkflow.workflowAppearAnimation($(this));
				});
			}
		},
		workflowAppearAnimation: function (workflow) {
			var workflowTimeout = 0;
			workflow.appear(function() {
				workflow.addClass('qodef--appear');
				workflow.find('.qodef-m-workflow-item').each(function() {
					var $thisWorkflowItem = $(this);
					setTimeout(function() {
						$thisWorkflowItem.addClass('qodef--appear');
					}, workflowTimeout);
					workflowTimeout += 200;
				})
			}, { accX: 0, accY: 100})
		}
	};
	
})(jQuery);
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

(function($){
    "use strict";

    var fixedHeaderAppearance = {
        showHideHeader: function($pageOuter, $header){
            if(qodef.windowWidth > 1024) {
                if (qodef.scroll <= 0) {
                    qodef.body.removeClass('qodef-header--fixed-display');
                    $pageOuter.css('padding-top', '0');
                    $header.css('margin-top', '0');
                } else {
                    qodef.body.addClass('qodef-header--fixed-display');
                    $pageOuter.css('padding-top', parseInt(qodefGlobal.vars.headerHeight + qodefGlobal.vars.topAreaHeight) + 'px');
                    $header.css('margin-top', parseInt(qodefGlobal.vars.topAreaHeight) + 'px');
                }
            }
        },
        init: function(){
            var $pageOuter = $('#qodef-page-outer'),
                $header = $('#qodef-page-header');
            fixedHeaderAppearance.showHideHeader($pageOuter, $header);
            $(window).scroll(function() {
                fixedHeaderAppearance.showHideHeader($pageOuter, $header);
            });
            $(window).resize(function() {
                $pageOuter.css('padding-top', '0');
                fixedHeaderAppearance.showHideHeader($pageOuter, $header);
            });
        }
    };
    
    qodef.fixedHeaderAppearance = fixedHeaderAppearance.init;

})(jQuery);
(function ($) {
	"use strict";
	
	var stickyHeaderAppearance = {
		displayAmount: function () {
			if (qodefGlobal.vars.qodefStickyHeaderScrollAmount !== 0) {
				return parseInt(qodefGlobal.vars.qodefStickyHeaderScrollAmount);
			} else {
				return parseInt(qodefGlobal.vars.headerHeight + qodefGlobal.vars.adminBarHeight);
			}
		},
		showHideHeader: function (displayAmount) {
			
			if (qodef.scroll < displayAmount) {
				qodef.body.removeClass('qodef-header--sticky-display');
			} else {
				qodef.body.addClass('qodef-header--sticky-display');
			}
		},
		init: function () {
			var displayAmount = stickyHeaderAppearance.displayAmount();
			
			stickyHeaderAppearance.showHideHeader(displayAmount);
			$(window).scroll(function () {
				stickyHeaderAppearance.showHideHeader(displayAmount);
			});
		}
	};
	
	qodef.stickyHeaderAppearance = stickyHeaderAppearance.init;
	
})(jQuery);
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

(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefHoverDir.init();
	});
	
	$(document).on('mildhill_trigger_get_new_posts', function () {
		qodefHoverDir.init();
	});
	
	var qodefHoverDir = {
		init: function () {
			var $gallery = $('.qodef-hover-animation--direction-aware');
			
			if ($gallery.length) {
				$gallery.each(function () {
					var $this = $(this);
					$this.find('article').each(function () {
						$(this).hoverdir({
							hoverElem: 'div.qodef-e-content',
							speed: 330,
							hoverDelay: 35,
							easing: 'ease'
						});
					});
				});
			}
		}
	};
	
})(jQuery);