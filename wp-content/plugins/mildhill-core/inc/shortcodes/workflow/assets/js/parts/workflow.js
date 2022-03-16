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