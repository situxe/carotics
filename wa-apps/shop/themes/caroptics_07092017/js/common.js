/*$(document).on('click', '.feature_show_all', function () {
    $(this).siblings('.feature_show_hide').slideToggle(300);
    if ($(this).html() == "Скрыть характеристики") {
        $(this).html("Все характеристики");
    } else {
        $(this).html("Скрыть характеристики");
    }
    return false;
});*/
(function ($) {


    $(document).ready(function () {
        // $('input[name=phone]').mask("+7 999 999 99 99");

        if ($('.brands-carousel').length ) {
            $('.brands-carousel').owlCarousel({
                loop: true,
                nav: false,
                navText: ['', ''],
                items: 5,
                responsiveClass: true,
                responsive: {
                    992: {
                        items: 5,
                    },
                    0: {
                        items: 1
                    }
                }
            });
        }

        if ($('.gallery_main a').length > 1) {
            $('.gallery_main').owlCarousel({
                loop: true,
                nav: false,
                items: 1
            });
        }


        if ($('.owl').length) {
            $(document).on('changed.owl.carousel', '.gallery_main', function (event) {
                n = event.page.index;
                $('.owl').trigger('to.owl.carousel', n);
            });
            $('.owl').owlCarousel({
                loop: false,
                navText: ['', ''],
                nav: true,
                center: true,
                responsiveClass: true,
                responsive: {
                    992: {
                        items: 5,
                        margin: 9,
                        mouseDrag: false,
                        startPosition: 0,
                    },
                    0: {
                        items: 1
                    }
                }
            });
            // Custom Navigation Events
            $(document).on('changed.owl.carousel', '.owl', function (event) {
                n = event.page.index;
                $('.gallery_main').trigger('to.owl.carousel', n);
            });
            $(document).on('click', '.owl .owl-item', function () {
                n = $(this).index();
                $('.owl').trigger('to.owl.carousel', n);
            });
        }
        if ($('.product_list_slider').length) {
            if (document.documentElement.clientWidth > 991) {
                $('.product_list_slider').owlCarousel({
                    loop: true,
                    nav: true,
                    navText: ['', ''],
                    responsiveClass: true,
                    responsive: {
                        1200: {
                            items: 6,
                            margin: 15
                        },
                        991: {
                            items: 4,
                            margin: 15
                        },
                        560: {
                            items: 3,
                            margin: 10
                        },
                        0: {
                            items: 2,
                            margin: 10
                        }
                    }

                });
            }

        }
        var owl = $('.owl');
        owl.owlCarousel();// Listen to owl events:
        /*  owl.on('translated.owl.carousel', function (event) {
         var center = $(this).find('.center img').attr('src');
         $('.product-gallery .img img').attr('src', center);
         console.log(center);
         })*/

        $('.row-close').click(function () {
            localStorage.setItem("deliveryrow", 1);
            $('.delivery-row').fadeOut('slow');
        });

        if ($('select').length) {
            $('select').styler();
        }

        if ($('.content-text').length) {
            $('.content-text .read-more').click(function () {
                $(this).hide();
                $('.more-text').fadeIn('slow');

            });
            $('.content-text .read-less').click(function () {
                $('.more-text').fadeOut('slow');
                $('.read-more').fadeIn('slow');

            });
        }

        if ($('.dropdown').length) {

            var width = document.documentElement.clientWidth;
            var divs = $(this).find('.dropdown');

            $('.drop-sum + .drop-menu').each(function () {
                $(this).css({
                    'height': $(this).find('ul').height()
                });
            });

            if (( width < 720) && ( width > 480)) {
                for (var i = 0; i < divs.length; i += 5) {
                    divs.slice(i, i + 5).wrapAll("<div class='item'></div>");
                }
            }
            if (width <= 480) {
                for (var i = 0; i < divs.length; i += 9) {
                    divs.slice(i, i + 9).wrapAll("<div class='item'></div>");
                }
            }

            if ($('.drop-sum').length) {
                $('.drop-sum').click(function () {
                    $(this).siblings('.drop-menu').toggleClass('active');
                    $(this).toggleClass('closed');
                });
                if (document.documentElement.clientWidth > 720) {
                    $('.marks .drop-sum').removeClass('closed');
                }
            }
        }

        $('#nav-icon').click(function () {
            $(this).toggleClass('open');
            $('.navigation .container').toggleClass('visual');
            $('.menu-wrapper').toggleClass('visual');
            $('body').toggleClass('oh');
        });

        if ($('.product-menus').length) {
            if (document.documentElement.clientWidth < 1200) {
                $('.product-menus-mobile').append($('.product-menus>*'));
                $('.payment-info-mobile').append($('.payment-info>*'));
            }
        }

        if ($('.accord').length) {
            if (document.documentElement.clientWidth < 992) {
                $('.accord').attr('data-toggle', 'collapse');
                $('.accord').attr('type', 'button');
                $('.accord').addClass('collapsed');
                $('.acc-target').addClass('collapse');
                $('#id1').on('shown.bs.collapse', function () {
                    var $carousel = $(".owl-related").owlCarousel({
                        loop: false,
                        navText: ['', ''],
                        nav: true,
                        responsiveClass: true,
                        responsive: {
                            1200: {
                                items: 6,
                                margin: 15
                            },
                            991: {
                                items: 4,
                                margin: 15
                            },
                            // 768:{
                            //     items: 4,
                            //     margin:10
                            // },
                            560: {
                                items: 3,
                                margin: 10
                            },
                            0: {
                                items: 2,
                                margin: 10
                            }
                        }
                    });
                });
            }
        }

        if ($('.filter-btn').length) {
            $('.filter-btn').click(function () {
                $('.sidebar').toggleClass('active');
            });
        }


        // показ скрытого блока (кнопка наверх) при прокрутке
        $(function (f) {
            var element = f('.ontop');
            f(window).scroll(function () {
                element['fade' + (f(this).scrollTop() > 300 ? 'In' : 'Out')](100);
            });
        });
        //плавная прокрутка ссылки с классом go_to до якоря (href=id)
        $('.header-menu a, #modalmenu a, .ontop a').click(function () { // ловим клик по ссылке с классом go_to
            var scroll_el = $(this).attr('href'); // возьмем содержимое атрибута href, должен быть селектором, т.е. например начинаться с # или .
            if ($(scroll_el).length != 0) { // проверим существование элемента чтобы избежать ошибки
                $('html, body').animate({scrollTop: $(scroll_el).offset().top}, 500); // анимируем скроолинг к элементу scroll_el
                $(".modal").modal('hide');//прячем  модальное окно
            }
            return false; // выключаем стандартное действие
        });
        $(".popcloser").on('click', function () {
            $('.popup').fadeOut('slow');
        });

    });

})(jQuery);
