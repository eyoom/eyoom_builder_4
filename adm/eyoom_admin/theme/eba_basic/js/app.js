/*!
 * Eyoom Admin app.js
 * Licensed under Eyoom License (http://eyoom.net/page/?pid=license)
 */

$(function() {
    "use strict";

    /* ------------------------------
	SMARTRESIZE JS
	------------------------------ */
    (function($,sr) {
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
    }) (jQuery,'smartresize');

    $(document).ready(function() {
        /* ------------------------------
        LAYOUT HEIGHT CALC JS
        ------------------------------ */
        var $HEADER = $('.header-bar'),
            $PAGE_CONTENT = $('.page-content');

        var setContentHeight = function() {
            var bodyHeight = $(window).height(),
                headerHeight = $HEADER.height(),
                contentHeight = bodyHeight - headerHeight;

            $PAGE_CONTENT.css('min-height', contentHeight);
        };

        $(window).smartresize(function() {
            setContentHeight();
        });
        setContentHeight();

        /* ------------------------------
        SIDEBAR NAV JS
        ------------------------------ */
        $('.nav-link').on('click', function() {
            var nextNav = $(this).siblings();
            var thisNav = $(this);
            if (nextNav.hasClass('sub-nav')) {
                if (nextNav.is(':visible')) {
                    thisNav.removeClass('visible-sub-nav');
                    nextNav.slideUp(200);
                } else {
                    $('.nav-link').each(function() {
                        $(this).removeClass('visible-sub-nav');
                    });
                    $('.sub-nav').each(function() {
                        $(this).slideUp(200);
                    });
                    thisNav.addClass('visible-sub-nav');
                    nextNav.slideDown(200);
                }
                return false;
            }
        });

        $('#sidebar_left_btn').on('click', function() {
            if ($('#wrapper').hasClass('close-nav')) {
                $('#wrapper').removeClass('close-nav');
                $('.visible-sub-nav + .sub-nav').slideDown(200);
                set_cookie('sidebar', '', 8760);
            } else {
                $('#wrapper').addClass('close-nav');
                $('.visible-sub-nav + .sub-nav').slideUp(200);
                set_cookie('sidebar', 'close', 8760);
            }
            return false;
        });

        $(document).on('mouseover', function(e) {
            e.stopPropagation();
            if ($('#wrapper').hasClass('close-nav') && $('#sidebar_left_btn').is(':visible')) {
                var mousePoint = $(e.target).closest('.sidebar-left').length;
                if (mousePoint) {
                    $('#wrapper').addClass('open-nav');
                    $('.visible-sub-nav + .sub-nav').slideDown(200);
                } else {
                    $('#wrapper').removeClass('open-nav');
                    $('.visible-sub-nav + .sub-nav').slideUp(200);
                }
            }
        });

        $('#sidebar_left_btn_mobile').on('click', function() {
            $('#wrapper').addClass('cover-left');
            return false;
        });

        $('#sidebar_right_btn').on('click', function() {
            $('#wrapper').addClass('cover-right');
            return false;
        });

        $(document).on('click', function(e) {
            e.stopPropagation();
            if ($('#wrapper').hasClass('cover-left')) {
                var mousePoint = $(e.target).closest('.sidebar-left').length;
                if (!mousePoint) {
                    $('#wrapper').removeClass('cover-left');
                }
            }
            if ($('#wrapper').hasClass('cover-right')) {
                var mousePoint = $(e.target).closest('.sidebar-right').length;
                if (!mousePoint) {
                    $('#wrapper').removeClass('cover-right');
                }
            }
        });

        $(".sidebar-cover").on("click", function() {
            $('#wrapper').removeClass('cover-left');
            $('#wrapper').removeClass('cover-right');
            return false;
        });
    });

    /* ------------------------------
    SCREENFULL JS
    ------------------------------ */
    $('.screenfull-btn').on('click', function(){
        if (screenfull.enabled) {
            screenfull.toggle();
        }
        return false;
    });

    /* ------------------------------
    COLLAPSE SEARCH BTN
    ------------------------------ */
    $(".collapse-search-btn").click(function() {
        if ($(this).find("span").text() == "검색 조건 열기") {
            $(this).find("span").text("검색 조건 닫기")
        } else {
            $(this).find("span").text("검색 조건 열기");
        }
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
	BACK TO TOP
	------------------------------ */
    $(".back-to-top").addClass("hidden-top");
        $(window).scroll(function() {
        if ($(this).scrollTop() === 0) {
            $(".back-to-top").addClass("hidden-top")
        } else {
            $(".back-to-top").removeClass("hidden-top")
        }
    });

    $('.back-to-top').click(function() {
        $('body,html').animate({scrollTop:0}, 500);
        return false;
    });

    /* ------------------------------
	SMARTEDITOR2 BUG SOLUTION
	------------------------------ */
    // 아래 스크립트가 없을 경우 부트스트랩 탭 내에 스마트에디터가 있을경우 iframe 높이값이 0이 되어 보이지 않음
    // 스마트에디터일경우 탭 클릭시 높이값 강제 설정
    $(".anchor-menu").on("click", function() {
        $(".smarteditor2").siblings("iframe").height(349);
    });
});