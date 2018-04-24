jQuery(document).ready(function($) {
    $(document).on("scroll", function() {});
    $('.go-down').on('click', function(e) { e.preventDefault(); var scr = $('#middle').offset().top;
        $('html, body').animate({ scrollTop: scr }, 1000); });
    $('.btn-open-menu').on('click', function(e) { e.preventDefault();
        $('#site-header').toggleClass('open'); });
    $(document).on("scroll", onScroll);
    $('.menu-scroll a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        $(document).off("scroll");
        $('.menu-scroll a').each(function() { $(this).removeClass('active'); })
        $(this).addClass('active');
        var target = this.hash,
            menu = target;
        $target = $(target);
        $('html, body').stop().animate({ 'scrollTop': $target.offset().top + 2 }, 500, 'swing', function() { window.location.hash = target;
            $(document).on("scroll", onScroll); });
    });
    $(document).on('scroll', function(e) { try { animateProc1();
            animateProc2();
            animateProc3(); } catch (e) {} });
    var header = $(".top-line");
    var scrollPrev = 0
    $(window).scroll(function() {
        if (!header.hasClass('uk-active')) return false;
        else var stylesHeaer = header.attr('style');
        var scrolled = $(window).scrollTop();
        var firstScrollUp = false;
        var firstScrollDown = false;
        if (scrolled > 0) {
            if (scrolled > scrollPrev) { firstScrollUp = false; if (scrolled < header.height() + header.offset().top) { if (firstScrollDown === false) { var topPosition = header.offset().top;
                        header.css({ "position": "fixed", "top": "-80px", 'left': '0', 'right': '0' });
                        firstScrollDown = true; } } else { header.css({ "position": "fixed", 'top': '-80px', 'left': '0', 'right': '0' }); } } else { firstScrollDown = false; if (scrolled > header.offset().top) { if (firstScrollUp === false) { var topPosition = header.offset().top;
                        header.css({ "position": "fixed", "top": "0px", 'left': '0', 'right': '0' });
                        firstScrollUp = true; } } else {} }
            scrollPrev = scrolled;
        }
    });

    function onScroll(event) { var scrollPos = $(document).scrollTop();
        $('.menu-scroll a').each(function(idx, el) { var currLink = $(el); var refElement = $(currLink.attr("href")); if (refElement.offset().top <= scrollPos && refElement.offset().top + refElement.height() > scrollPos) { $(el).removeClass("active");
                currLink.addClass("active");
                console.log(currLink.attr("href"), refElement.attr('id')); } else { currLink.removeClass("active"); } }); }
})