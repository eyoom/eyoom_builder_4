/*!
 * Eyoom Admin app.js
 * Licensed under Eyoom License (http://eyoom.net/page/?pid=license)
 */

var App = function () {

    function handleViewport(){
		$("input, textarea, select, button, i, div.note-editing-area, span.select2-selection, .calendar-time, ul.tag-editor, div.asSpinner-control").on({ 'touchstart' : function() {
			zoomDisable();
		}});
		$("input, textarea, select, button, i, div.note-editing-area, span.select2-selection, .calendar-time, ul.tag-editor, div.asSpinner-control").on({ 'touchend' : function() {
			setTimeout(zoomEnable, 500);
		}});
		function zoomDisable(){
			$('head meta[name=viewport]').remove();
			$('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">');
		}
		function zoomEnable(){
			$('head meta[name=viewport]').remove();
			$('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1">');
		}
	}

	function handleLayout(){
		(function($,sr){
		    var debounce = function (func, threshold, execAsap) {
		      var timeout;

		        return function debounced () {
		            var obj = this, args = arguments;
		            function delayed () {
		                if (!execAsap)
		                    func.apply(obj, args);
		                timeout = null;
		            }

		            if (timeout)
		                clearTimeout(timeout);
		            else if (execAsap)
		                func.apply(obj, args);

		            timeout = setTimeout(delayed, threshold || 100);
		        };
		    };
		    jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };
		})(jQuery,'smartresize');

		var $WRAPPER = $('.wrapper'),
			$EB_HEADER = $('.eb-header'),
			$EB_MAINAREA = $('.eb-mainarea');

		$(document).ready(function () {
		    var setContentHeight = function () {
		        var wrapperHeight = $(window).height(),
		        	headerHeight = $EB_HEADER.height(),
		        	contentHeight = wrapperHeight - headerHeight;

		        $EB_MAINAREA.css('min-height', contentHeight);
		    };

		    $(window).smartresize(function(){
		        setContentHeight();
		    });
		    setContentHeight();

		    $('#eb_sidebar_btn_left').on('click', function () {
		        var sidebarMenuText = $('.menu-item-text');

		        if ($('.wrapper').hasClass('eb-close-menu')) {
		            $('.wrapper').removeClass('eb-close-menu');

		            $('.eb-visible-submenu + .eb-menu-sub').slideDown();

		            $('.eb-sidebar-left').one('transitionend', function (e) {
		                sidebarMenuText.removeClass('eb-lg-opacity-0');
		                sidebarMenuText.removeClass('eb-lg-display-none');
		            });

		        } else {
		            $('.wrapper').addClass('eb-close-menu');

		            $('.eb-visible-submenu + .eb-menu-sub').slideUp();

		            sidebarMenuText.addClass('eb-lg-opacity-0');
		            $('.eb-sidebar-left').one('transitionend', function (e) {
		                sidebarMenuText.addClass('eb-lg-display-none');
		            });
		        }
		        return false;
		    });

		    $(document).on('mouseover', function (e) {
		        e.stopPropagation();

		        if ($('.wrapper').hasClass('eb-close-menu') && $('#eb_sidebar_btn_left').is(':visible')) {
		            var mousePoint = $(e.target).closest('.eb-sidebar-left').length;
		            if (mousePoint) {
		                $('.wrapper').addClass('eb-open-menu');
		                $('.eb-visible-submenu + .eb-menu-sub').slideDown();

		                var sidebarMenuText = $('.menu-item-text');
		                sidebarMenuText.removeClass('eb-lg-display-none');
		                sidebarMenuText.removeClass('eb-lg-opacity-0');

		            } else {
		                $('.wrapper').removeClass('eb-open-menu');
		                $('.eb-visible-submenu + .eb-menu-sub').slideUp();

		                var sidebarMenuText = $('.menu-item-text');
		                sidebarMenuText.addClass('eb-lg-opacity-0');
		                sidebarMenuText.addClass('eb-lg-display-none');
		            }
		        }
		    });

		    $('.eb-menu-link').on('click', function () {
		        var nextMenu = $(this).next();
		        var thisMenu = $(this);

		        if (nextMenu.hasClass('eb-menu-sub')) {

		            if (nextMenu.is(':visible')) {
		                thisMenu.removeClass('eb-visible-submenu');
		                nextMenu.slideUp();
		            } else {
		                $('.eb-menu-link').each(function () {
		                    $(this).removeClass('eb-visible-submenu');
		                });

		                $('.eb-menu-sub').each(function () {
		                    $(this).slideUp();
		                });

		                thisMenu.addClass('eb-visible-submenu');
		                nextMenu.slideDown();
		            }
		            return false;
		        }
		    });

		    $('#eb_sidebar_btn_left_mobile').on('click', function () {
		        $('.wrapper').addClass('eb-cover-left');
		        return false;
		    });

		    $('#eb_sidebar_btn_right').on('click', function () {
		        $('.wrapper').addClass('eb-cover-right');
		        return false;
		    });

		    $(document).on('click', function (e) {
		        e.stopPropagation();

		        if ($('.wrapper').hasClass('eb-cover-left')) {
		            var mousePoint = $(e.target).closest('.eb-sidebar-left').length;
		            if (!mousePoint) {
		                $('.wrapper').removeClass('eb-cover-left');
		            }
		        }

		        if ($('.wrapper').hasClass('eb-cover-right')) {
		            var mousePoint = $(e.target).closest('.eb-sidebar-right').length;
		            if (!mousePoint) {
		                $('.wrapper').removeClass('eb-cover-right');
		            }
		        }
		    });

		    $(".eb-sidebar-mask").on("click", function() {
		        $('.wrapper').removeClass('eb-cover-left');
		        $('.wrapper').removeClass('eb-cover-right');
		        return false;
		    });

			if ($(window).width() > 991 && $(window).width() < 1200) {
			    $('.wrapper').addClass('eb-close-menu');
			} else if ($(window).width() >= 1200) {
				$('.wrapper').removeClass('eb-close-menu');
				$('.menu-item-text').removeClass('eb-lg-opacity-0');
				$('.menu-item-text').removeClass('eb-lg-display-none');
			}

			$(window).on('resize', function() {
				if ($(window).width() > 991 && $(window).width() < 1200) {
				    $('.wrapper').addClass('eb-close-menu');
				} else if ($(window).width() >= 1200) {
					$('.wrapper').removeClass('eb-close-menu');
					$('.menu-item-text').removeClass('eb-lg-opacity-0');
					$('.menu-item-text').removeClass('eb-lg-display-none');
				}
			});
		});
	}

	function handleIEFixes(){
        //fix html5 placeholder attribute for ie7 & ie8
        if (jQuery.browser.msie && jQuery.browser.version.substr(0, 1) < 9) { // ie7&ie8
            $('input[placeholder], textarea[placeholder]').each(function () {
                var input = jQuery(this);
                $(input).val(input.attr('placeholder'));
                $(input).focus(function () {
                    if (input.val() == input.attr('placeholder')) {
                        input.val('');
                    }
                });
                $(input).blur(function () {
                    if (input.val() == '' || input.val() == input.attr('placeholder')) {
                        input.val(input.attr('placeholder'));
                    }
                });
            });
        }
    }

    function handleBootstrap(){
        /*Tooltips*/
        $('.tooltips').tooltip();
        $('.tooltips-show').tooltip('show');
        $('.tooltips-hide').tooltip('hide');
        $('.tooltips-toggle').tooltip('toggle');
        $('.tooltips-destroy').tooltip('destroy');
        /*Popovers*/
        $('.popovers').popover();
        $('.popovers-show').popover('show');
        $('.popovers-hide').popover('hide');
        $('.popovers-toggle').popover('toggle');
        $('.popovers-destroy').popover('destroy');
    }

    function handleToggle(){
        $('.list-toggle').on('click', function() {
            $(this).toggleClass('active');
        });
    }

    function handleTimeCal(){
	    $(document).ready(function () {
		    var interval = setInterval(function () {
		        var ebHeaderDt = moment();
		        $('#eb_year').html(ebHeaderDt.format('YYYY'));
		        $('#eb_date').html(ebHeaderDt.format('MM월 DD일'));
		        $('#eb_week').html(ebHeaderDt.format('dddd').substring(0, 3).toUpperCase());
		        $('#eb_time').html(ebHeaderDt.format('hh : mm A'));
		    }, 1000);

	        $('#sidebar_carlendar').datepicker({
	            dateFormat: 'yy-mm-dd',
	            prevText: '<i class="fa fa-angle-left"></i>',
	            nextText: '<i class="fa fa-angle-right"></i>',
	            showMonthAfterYear: true,
	            monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
	            monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
	            dayNamesMin: ['일','월','화','수','목','금','토']
	        });
		});
	}

	function handleBackToTop(){
		jQuery(document).ready(function () {
			$(".back-to-top").addClass("hidden-top");
				$(window).scroll(function () {
				if ($(this).scrollTop() === 0) {
					$(".back-to-top").addClass("hidden-top")
				} else {
					$(".back-to-top").removeClass("hidden-top")
				}
			});

			$('.back-to-top').click(function () {
				$('body,html').animate({scrollTop:0}, 1200);
				return false;
			});
		});
	}

    function handleWaves(){
		Waves.init();
	}

    function handleScreenFull(){
		$('.eb-header-screenfull').on('click', function(){
		    if (screenfull.enabled) {
		        screenfull.toggle();
		    }
		});
	}

    return {
        init: function(){
	        handleViewport();
	        handleLayout();
	        handleIEFixes();
            handleBootstrap();
            handleToggle();
            handleTimeCal();
            handleBackToTop();
            handleWaves();
            handleScreenFull();
        },
    };

}();