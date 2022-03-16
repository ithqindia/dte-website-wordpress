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
