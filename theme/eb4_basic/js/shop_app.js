(function($) {
    'use strict';

	/* ------------------------------
	SUB NAV JS
	------------------------------ */
	$(document).ready(function() {
		$(".sub-nav-title").click(function(){
			$(this).parent().find("ul").slideToggle(300);
			$(this).parent().siblings().find("ul").slideUp(300);
			return false;
		});
	});
	
	/* ------------------------------
	ANIMATION JS
	------------------------------ */
	$(function() {
	
		function ckScrollInit(items, trigger) {
			items.each(function() {
				var ckElement = $(this),
					AnimationClass = ckElement.attr('data-animation'),
					AnimationDelay = ckElement.attr('data-animation-delay');
	
				ckElement.css({
					'-webkit-animation-delay': AnimationDelay,
					'-moz-animation-delay': AnimationDelay,
					'animation-delay': AnimationDelay,
					opacity: 0
				});
	
				var ckTrigger = (trigger) ? trigger : ckElement;
	
				ckTrigger.waypoint(function() {
					ckElement.addClass("animated").css("opacity", "1");
					ckElement.addClass('animated').addClass(AnimationClass);
				}, {
					triggerOnce: true,
					offset: '90%',
				});
			});
		}
	
		ckScrollInit($('.animation'));
		ckScrollInit($('.staggered-animation'), $('.staggered-animation-wrap'));
	
	});

	/* ------------------------------
	BOOTSTRAP TOOLTIP
	------------------------------ */
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		return new bootstrap.Tooltip(tooltipTriggerEl)
	});

	/* ------------------------------
	BOOTSTRAP POPOVER
	------------------------------ */
	var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
	var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
		return new bootstrap.Popover(popoverTriggerEl)
	});
    
    /* ------------------------------
	SEARCH FULL TOGGLE
	------------------------------ */
	$(document).ready(function() {
		$('.search-toggle').on('click', function() {
			$('.search-full').show();
		});
		$('.search-close-btn').on('click', function() {
			$('.search-full').hide();
		});
	});

	/* ------------------------------
	FOOTER FAMILY SITE DROPUP
	------------------------------ */
	$(document).ready(function(){
		$(".family-site dt a").click(function(){
			$(".family-site dd").slideToggle(300);
			return false;
		});
	});

	/* ------------------------------
	BACK TO TOP
	------------------------------ */
	$(document).ready(function() {
		var prgsPath = document.querySelector('.eb-backtotop path');
		var pathLength = prgsPath.getTotalLength();
		prgsPath.style.transition = prgsPath.style.WebkitTransition = 'none';
		prgsPath.style.strokeDasharray = pathLength + ' ' + pathLength;
		prgsPath.style.strokeDashoffset = pathLength;
		prgsPath.getBoundingClientRect();
		prgsPath.style.transition = prgsPath.style.WebkitTransition = 'stroke-dashoffset 0.01s linear';

		var chkPrgs = function() {
			var scrollTop = $(window).scrollTop();
			var pageHeight = $(document).height() - $(window).height();
			var percentage = (scrollTop / pageHeight) * 100;
			var textColor;
			var prgs = pathLength - (scrollTop * pathLength / pageHeight);
			prgsPath.style.strokeDashoffset = prgs;

			if (percentage > 99) {
				textColor = '#2b2b2e';
			} else {
				textColor = '#a5a5a5';
			}

			$('.progress-count').text(Math.round(percentage) + '%').css({ color: textColor });
		}
		chkPrgs();
		$(window).scroll(chkPrgs);
		$(window).on('scroll', function() {
			if ($(this).scrollTop() > 50) {
				$('.eb-backtotop').addClass('active-progress');
			} else {
				$('.eb-backtotop').removeClass('active-progress');
			}
		});				
		$('.eb-backtotop, .btt-up-btn').on('click', function(e) {
			e.preventDefault();
			$('html, body').animate({scrollTop: 0}, 500);
			return false;
		});
		$('.btt-down-btn').on('click', function(e) {
			e.preventDefault();
			$('html, body').animate({scrollTop:$(document).height()}, 500);
			return false;
		})
	});

})(jQuery);