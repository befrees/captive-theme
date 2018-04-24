//# sourceURL=front.js
/*!
 * jQuery htmlDoc "fixer" - v0.2pre - 8/8/2011
 * http://benalman.com/projects/jquery-misc-plugins/
 *
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */

(function($) {
  // RegExp that matches opening and closing browser-stripped tags.
  // $1 = slash, $2 = tag name, $3 = attributes
  var matchTag = /<(\/?)(html|head|body|title|base|meta)(\s+[^>]*)?>/ig;
  // Unique id prefix for selecting placeholder elements.
  var prefix = 'hd' + +new Date;
  // A node under which a temporary DOM tree can be constructed.
  var parent;

  $.htmlDoc = function(html) {
    // A collection of "intended" elements that can't be rendered cross-browser
    // with .innerHTML, for which placeholders must be swapped.
    var elems = $();
    // Input HTML string, parsed to include placeholder DIVs. Replace HTML,
    // HEAD, BODY tags with DIV placeholders.
    var htmlParsed = html.replace(matchTag, function(tag, slash, name, attrs) {
      // Temporary object in which to hold attributes.
      var obj = {};
      // If this is an opening tag...
      if ( !slash ) {
        // Add an element of this name into the collection of elements. Note
        // that if a string of attributes is added at this point, it fails.
        elems = elems.add('<' + name + '/>');
        // If the original tag had attributes, create a temporary div with
        // those attributes. Then, copy each attribute from the temporary div
        // over to the temporary object.
        if ( attrs ) {
          $.each($('<div' + attrs + '/>')[0].attributes, function(i, attr) {
            obj[attr.name] = attr.value;
          });
        }
        // Set the attributes of the intended object based on the attributes
        // copied in the previous step.
        elems.eq(-1).attr(obj);
      }
      // A placeholder div with a unique id replaces the intended element's
      // tag in the parsed HTML string.
      return '<' + slash + 'div'
        + (slash ? '' : ' id="' + prefix + (elems.length - 1) + '"') + '>';
    });

    // If no placeholder elements were necessary, just return normal
    // jQuery-parsed HTML.
    if ( !elems.length ) {
      return $(html);
    }
    // Create parent node if it hasn't been created yet.
    if ( !parent ) {
      parent = $('<div/>');
    }
    // Create the parent node and append the parsed, place-held HTML.
    parent.html(htmlParsed);
    // Replace each placeholder element with its intended element.
    $.each(elems, function(i) {
      var elem = parent.find('#' + prefix + i).before(elems[i]);
      elems.eq(i).html(elem.contents());
      elem.remove();
    });
    // Return the topmost intended element(s), sans text nodes, while removing
    // them from the parent element with unwrap.
    return parent.children().unwrap();
  };

}(jQuery));
// 
jQuery(document).ready(function($) {

    $.fn.equivalent = function() {
        //запишем значение jQuery выборки к которой будет применена эта функция в локальную переменную $blocks
        var $blocks = $(this),
            //примем за максимальную высоту - высоту первого блока в выборке и запишем ее в переменную maxH
            // maxH = $blocks.eq(0).height();
            maxH = parseInt($blocks.eq(0).css('height'), 10);


        //делаем сравнение высоты каждого блока с максимальной
        $blocks.each(function() {
            maxH = ($(this).height() > maxH) ? $(this).height() : maxH;
            console.log(maxH);
            /*
            Этот блок можно записать так:
            if ( $(this).height() > maxH ) {
                maxH = $(this).height();
            }
            */
        });

        //устанавливаем найденное максимальное значение высоты для каждого блока jQuery выборки
        $blocks.height(maxH);
        // ddd
    }



    $('select').styler();

    $('body').on('click', '.footer-toggle', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $('#site-footer').toggleClass('footer-show');
    });

    $('.nav-main-menu > li').hoverIntent({
        over: function() {
            if ($(window).width() <= 1049) return false;
            $(this).addClass('open-item').children('ul').slideDown(150);
        },
        out: function() {
            if ($(window).width() <= 1049) return false;
            $(this).removeClass('open-item').children('ul').slideUp(150);
        },
        timeout: 150
    });

    $('body').on('change', '#companies-select', function(e) {
        loadPage($(this).val());
    });


    $('body').on('click', '.nav-main-menu a, .logo-link, .ajax-link, .ajax-links a', function(e) {
        e.preventDefault();
        var a = $(this);
        loadPage(a.attr('href'));
    });
    $('body').on('click', '.tag-link a', function(e) {
        e.preventDefault();
        // e.stopPropagation();
        var a = $(this);
        loadPage(this.href);
        // $('#dropdown-tags').dropdown('toggle');
    });

    $(window).on('.popstate', function(e) {
        loadPage(location.href);
    });
    var progressBar = $('.loader-progress');

    function loadPage(href) {
        if (href == '#') return false;
        // console.log(href);

        progressBar.width(0).animate({ width: '50%' }, 600, function() {
            $('.loader-progress').animate({ width: '80%' }, 1000)
        });
        $.get(href, '', function(d) {
            progressBar.stop().animate({ width: '100%' }, 100);

            $('#middle').html($('#middle', $.parseHTML(d)).html());

            // console.log($('head'), $.parseHTML(d));
            // $("head").html('NEW STUFF IN HEAD');
            // var newHead = $(d).filter('head').html();
            // window.top.document.head = newHead;
            // $(document).html(d);
            // $("head").html($.htmlDoc(d).find('head').html());
            // $("html").html(d);

            var headIni = d.toLowerCase().indexOf("<head");
            var headEnd = d.toLowerCase().indexOf("</head>");
            headIni = d.indexOf(">", headIni + 1) + 1;
            var headHTML = d.substring(headIni, headEnd);
            // console.log(headHTML);
            // $("head").html(headHTML);
            var newHeadImgOG = $(d).filter('[property="og:image"]');
            console.log(newHeadImgOG).attr('content'));
            if(!$('head').find('[property="og:image"]').length){
                $('head').append($('<meta />', {
                    "property": 'og:image'
                }));
            }
            $('head').find('[property="og:image"]').attr('content', $(newHeadImgOG).attr('content'));
            console.log(newHeadImgOG);

            var newTitle = $(d).filter('title').text();
            window.top.document.title = newTitle;

            var parser = new DOMParser();
            doc = parser.parseFromString(d, "text/html");
            // Your class(es)
            var docClass = doc.body.getAttribute('class');
            parser = doc = null;

            $('body').attr('class', docClass);
            progressBar.stop().css('width', '100%');
            $('select').styler();
            $('body, html').animate({ scrollTop: 0 }, 150, function() {
                progressBar.width(0);
            });
            slickSliderInit();
            scrollPostLoad();
            $('.collapse').collapse('hide');
            
            if (history.pushState) {
                var _url = window.location.protocol + "//" + window.location.host;
                href = href.replace(_url, '');
                var newurl = window.location.protocol + "//" + window.location.host + href;
                window.history.pushState({ path: newurl }, '', newurl);
            }
        }, 'html');
    }

    var scrollProgress = (function scrollProgress() {
        if ($('body').hasClass('single-post')) {
            let percent = ($(window).scrollTop() + $(window).height()) / $('body').height() * 100;
            progressBar.css({
                width: percent + '%'
            })
        }
        return scrollProgress;
    }());
    $(window).scroll(function(e) {
        scrollProgress();
    });


    var slickSliderInit = (function slickSliderInit() {
        try {
            $('.slider .blog-list-item .card').equivalent();

            $('.slider').slick({
                autoplay: false,
                autoplaySpeed: 1000,
                dots: true,
                slidesToShow: 4,
                slidesToScroll: 4,
                lazyLoad: 'ondemand',
                arrows: false,
                adaptiveHeight: true,
                responsive: [{
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 860,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 640,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    }
                ]
            }).on('init', function(slick) {
                // console.log($('.slider').find('.slick-track').height());
            });
        } catch (e) {}
        return slickSliderInit;
    }());



    var scrollPostLoad = (function scrollPostLoad() {
        if (!$('.preloader-flag').length) return scrollPostLoad;
        try {
            var bottomOffset = $('.preloader-flag').offset().top;
            var dataAjax = $('#data-ajax').data();

            var windowHeight = $(window).height();
            var docHeight = $(document).height();
            var docScroll = $(document).scrollTop();

            // console.log(dataAjax);
            var data = {
                'action': 'loadmore',
                'query': dataAjax.true_posts,
                'page': dataAjax.current_page
            };
            // console.log($(window).height(), $(document).height(), $(document).scrollTop() , (bottomOffset - $(window).height()), ($(document).height() - bottomOffset), bottomOffset);

            if (
                //$(document).scrollTop() > ($(document).height() - bottomOffset) 
                $(document).scrollTop() > (bottomOffset - $(window).height() - 200) &&
                !$('body').hasClass('loading') &&
                !$('body').hasClass('no-loading') ||
                windowHeight > (bottomOffset - 200)
            ) {
                $.ajax({
                    url: dataAjax.ajaxurl,
                    data: data,
                    type: 'POST',
                    beforeSend: function(xhr) {
                        $('body').addClass('loading');
                    },
                    success: function(data) {
                        if (data) {
                            $('#load_more_gs').append(data);
                            $('body').removeClass('loading');
                            dataAjax.current_page++;
                            if ($(window).height() > (bottomOffset - 200))
                                scrollPostLoad();
                        } else {
                            $('body').removeClass('loading');
                            // $('#load_more_gs').remove();
                            $('body').addClass('no-loading');
                        }
                    }
                });
            }
        } catch (e) {}
        return scrollPostLoad;
    }());



    //применяем нашу функцию в элементам jQuery выборки - $('.nav')
    // $('.slider .blog-list-item').equivalent();



    $(document).on("scroll", function() {
        // return true;
        scrollPostLoad();
    });



    var header = $(".header-wrapper .navbar"); // Меню
    var headerHeight = 59;
    var scrollPrev = 0 // Предыдущее значение скролла

    $(document).scroll(function() {
        // if(!header.hasClass('uk-active')) return false;
        // else var stylesHeaer = header.attr('style');
        var scrolled = $(window).scrollTop(); // Высота скролла в px
        var firstScrollUp = false; // Параметр начала сколла вверх
        var firstScrollDown = false; // Параметр начала сколла вниз

        var scrollerHeader = scrolled < headerHeight ? scrolled : headerHeight;

        // console.log(scrolled);

        // Если скроллим
        if (scrolled > 0) {
            // Если текущее значение скролла > предыдущего, т.е. скроллим вниз
            if (scrolled > scrollPrev) {
                firstScrollUp = false; // Обнуляем параметр начала скролла вверх
                // Если меню видно
                if (scrolled < header.height() + header.offset().top) {
                    // Если только начали скроллить вниз
                    if (firstScrollDown === false && !$('body').hasClass('scroll-top')) {
                        var topPosition = header.offset().top; // Фиксируем текущую позицию меню
                        header.css({
                            // "top": topPosition + "px"
                            "position": "fixed",
                            // "top": "-" + scrollerHeader + "px",
                            "top": "-" + headerHeight + "px",
                            'left': '0',
                            'right': '0'
                        });
                        $('body').addClass('scroll-top').removeClass('scroll-bottom');
                        firstScrollDown = true;
                    }
                    // Позиционируем меню абсолютно
                    // header.css({
                    //     // "position": "absolute"
                    // });
                    // Если меню НЕ видно
                } else {
                    // Позиционируем меню фиксированно вне экрана
                    header.css({
                        "position": "fixed",
                        // "top": "-" + header.height() + "px"
                        'top': '-' + headerHeight + 'px',
                        'left': '0',
                        'right': '0'
                    });

                    $('body').addClass('scroll-top').removeClass('scroll-bottom');
                }

                // Если текущее значение скролла < предыдущего, т.е. скроллим вверх
            } else {
                firstScrollDown = false; // Обнуляем параметр начала скролла вниз
                // console.log('top');
                // Если меню не видно
                if (scrolled > header.offset().top && !$('body').hasClass('scroll-bottom')) {
                    // Если только начали скроллить вверх
                    if (firstScrollUp === false) {
                        var topPosition = header.offset().top; // Фиксируем текущую позицию меню
                        header.css({
                            // "top": topPosition + "px"
                            "position": "fixed",
                            "top": "0px",
                            'left': '0',
                            'right': '0'
                        });

                        $('body').addClass('scroll-bottom').removeClass('scroll-top');
                        firstScrollUp = true;
                    }
                    // Позиционируем меню абсолютно
                    // header.css({
                    //     // "position": "absolute"
                    // });
                } else {
                    // Убираем все стили
                    // header.removeAttr("style");
                }
            }
            // Присваеваем текущее значение скролла предыдущему
            scrollPrev = scrolled;
        } else {
            header.css({
                // "top": topPosition + "px"
                "position": "fixed",
                "top": "0px",
                'left': '0',
                'right': '0'
            });
            $('body').addClass('scroll-bottom').removeClass('scroll-top');
        }
    });

    ///////////////////////////////////////////////

});