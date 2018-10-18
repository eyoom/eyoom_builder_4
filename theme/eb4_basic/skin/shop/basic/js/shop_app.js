var ShopApp = function() {

    function handleLayout() {
        (function($,sr){
            var debounce = function (func, threshold, execAsap) {
                var timeout;

                return function debounced() {
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
            $TOPBAR = $('.header-topbar'),
            $TITLE = $('.header-title'),
            $NAV = $('.header-nav');
            $FOOTER = $('.footer');
            $FOOTERTOP = $('.footer-top');
            $SIDE = $('.basic-body-side');
            $BODYMAIN = $('.basic-body-main');

        $(document).ready(function() {
            var setContentHeight = function() {
                var wrapperHeight = $WRAPPER.outerHeight(),
                    topbarHeight = $TOPBAR.height(),
                    titleHeight = $TITLE.height(),
                    navHeight = $NAV.height(),
                    footerHeight = $FOOTER.height(),
                    footertopHeight = $FOOTERTOP.height(),
                    sideHeight = $SIDE.height();

                contentHeight = $(window).height() - topbarHeight - titleHeight - navHeight - (footertopHeight + 32);
                $BODYMAIN.css('min-height', contentHeight);

                if (contentHeight < sideHeight) {
                    $BODYMAIN.css('min-height', sideHeight + 50);
                } else {
                    $BODYMAIN.css('min-height', contentHeight);
                }
            };

            $(window).smartresize(function() {
                setContentHeight();
            });
            setContentHeight();
        });
    }

    function handleViewport() {
        $("input, textarea, select, button, i, div.note-editing-area, span.select2-selection, .calendar-time, ul.tag-editor, div.asSpinner-control").on({ 'touchstart' : function() {
            zoomDisable();
        }});
        $("input, textarea, select, button, i, div.note-editing-area, span.select2-selection, .calendar-time, ul.tag-editor, div.asSpinner-control").on({ 'touchend' : function() {
            setTimeout(zoomEnable, 500);
        }});
        function zoomDisable() {
            $('head meta[name=viewport]').remove();
            $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">');
        }
        function zoomEnable() {
            $('head meta[name=viewport]').remove();
            $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1">');
        }
    }

    function handleIEFixes() {
        //fix html5 placeholder attribute for ie7 & ie8
        if (jQuery.browser.msie && jQuery.browser.version.substr(0, 1) < 9) { // ie7&ie8
            $('input[placeholder], textarea[placeholder]').each(function () {
                var input = jQuery(this);
                $(input).val(input.attr('placeholder'));
                $(input).focus(function() {
                    if (input.val() == input.attr('placeholder')) {
                        input.val('');
                    }
                });
                $(input).blur(function() {
                    if (input.val() == '' || input.val() == input.attr('placeholder')) {
                        input.val(input.attr('placeholder'));
                    }
                });
            });
        }
    }

    function handleBootstrap() {
        /*Bootstrap Carousel*/
        $('.carousel').carousel({
            interval: 15000,
            pause: 'hover'
        });
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

    function handleToggle() {
        $('.list-toggle').on('click', function() {
            $(this).toggleClass('active');
        });
    }

    function handleSticky() {
        var stickyAddClass = function() {
            $("#header-fixed .header-sticky").addClass("header-fixed-trans");
            $("#header-fixed .header-sticky-space").addClass("header-fixed-space-trans");
        }
        var stickyRemoveClass = function() {
            $("#header-fixed .header-sticky").removeClass("header-fixed-trans");
            $("#header-fixed .header-sticky-space").removeClass("header-fixed-space-trans");
        }
        $(window).scroll(function() {
            if ($("#header-fixed").hasClass("fixed-main")) {
                if ($(window).scrollTop()>500){ stickyAddClass(); } else { stickyRemoveClass(); }
            } else {
                if ($(window).scrollTop()>100){ stickyAddClass(); } else { stickyRemoveClass(); }
            }
            if ($("#header-fixed .header-sticky").hasClass("header-fixed-trans")) {
                $("#nav_category").removeClass("nav-category-main");
            } else {
                $("#nav_category").addClass("nav-category-main");
            }
        });
    }

    function handleCategory() {
        if ($(window).width() >= 992) {
            var cateitem = 9;
            if (cateitem <= $("#nav_category > ul >li").length) {
                $('#nav_category > ul').append('<li class="navcate-load-more"><strong class="more-view">카테고리 더보기<i class="fa fa-plus margin-left-10"></i></strong></li>');
            }
            var show_cateitem = cateitem - 1;
            $('#nav_category > ul > li.item-vertical').each(function(i) {
                if (i > show_cateitem) {
                    $(this).css('display', 'none');
                }
            });
            $("#nav_category > ul > li.navcate-load-more").click(function () {
                if ($(this).hasClass('open')) {
                    $('#nav_category > ul > li.item-vertical').each(function(i) {
                        if (i > show_cateitem) {
                            $(this).slideUp(200);
                            $(this).css('display', 'none');
                        }
                    });
                    $(this).removeClass('open');
                    $('#nav_category > ul > li.navcate-load-more').html('<strong class="more-view">카테고리 더보기<i class="fa fa-plus margin-left-10"></i></strong>');
                } else {
                    $('#nav_category > ul > li.item-vertical').each(function(i) {
                        if (i > show_cateitem) {
                            $(this).slideDown(200);
                        }
                    });
                    $(this).addClass('open');
                    $('#nav_category > ul > li.navcate-load-more').html('<strong class="more-view">카테고리 닫기<i class="fa fa-minus margin-left-10"></i></strong>');
                }
            })
        } else {
            $('.item-vertical.dropdown').on('show.bs.dropdown', function(e) {
                $(this).find('.dropdown-menu').first().stop(true, true).slideDown(200);
            });
            $('.item-vertical.dropdown').on('hide.bs.dropdown', function(e) {
                $(this).find('.dropdown-menu').first().stop(true, true).slideUp(200);
            });
        }
    }

    function handleSidebar() {
        var sides = ["left", "top", "right", "bottom"];
        for (var i = 0; i < sides.length; ++i) {
            var cSide = sides[i];
            $(".sidebar." + cSide).sidebar({side: cSide});
        }
        $(".sidebar-left-trigger[data-action]").on("click", function() {
            var $this = $(this);
            var action = $this.attr("data-action");
            var side = $this.attr("data-side");
            $(".sidebar." + side).trigger("sidebar:" + action);
            $("html").toggleClass("overflow-hidden");
            $(".sidebar-left-mask, .sidebar-left-content").toggleClass("active");
            return false;
        });
        $(".sidebar-right-trigger[data-action]").on("click", function() {
            var $this = $(this);
            var action = $this.attr("data-action");
            var side = $this.attr("data-side");
            $(".sidebar." + side).trigger("sidebar:" + action);
            $("html").toggleClass("overflow-hidden");
            $(".sidebar-right-mask").toggleClass("active");
            return false;
        });
        $(".sidebar-shop-trigger").on("click", function() {
            $(".sidebar-shop-member").animate({width:"toggle"}, 200);
            $("html").toggleClass("overflow-hidden");
            $(".sidebar-shop-member-btn, .sidebar-shop-mask").toggleClass("active");
            return false;
        });
        $(".shop-member-box-btn").on("click", function() {
            $(this).next(".op-area").slideToggle(300).siblings(".op-area").slideUp();
        });
        setTimeout(function() {
            $(".sidebar").show();
        }, 500);
        $(window).resize(function() {
            $(".sidebar").show();
        });
    }

    function handleBackToTop() {
        $(document).ready(function() {
            $(".back-to-top").addClass("hidden-top");
                $(window).scroll(function() {
                if ($(this).scrollTop() === 0) {
                    $(".back-to-top").addClass("hidden-top")
                } else {
                    $(".back-to-top").removeClass("hidden-top")
                }
            });

            $('.back-to-top').click(function() {
                $('body,html').animate({scrollTop:0}, 1200);
                return false;
            });

            $('.quick-scroll-btn.top-btn').click(function() {
                $('body,html').animate({scrollTop:0}, 1200);
                return false;
            });

            $('.quick-scroll-btn.down-btn').click(function() {
                $('body,html').animate({scrollTop:$(document).height()}, 1200);
                return false;
            });
        });
    }

    return {
        init: function() {
            handleLayout();
            handleViewport();
            handleBootstrap();
            handleIEFixes();
            handleToggle();
            handleSticky();
            handleCategory();
            handleSidebar();
            handleBackToTop();
        }
    };

}();