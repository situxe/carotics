/*скроллинг наверх*/
function scroll_top_button_show() {
    if ($(window).scrollTop() > 100) {
        $('.button_top_block a').css('opacity', '1');
    } else {
        $('.button_top_block a').css('opacity', '0');
    }
}
$(document).scroll(function () {
    scroll_top_button_show();
});
scroll_top_button_show();
$(document).on('click', '.button_top_block a', function () {
    $('body').animate({scrollTop: 0}, 500);
    return false;
});
/*!скроллинг наверх*/


/*скроллинг фильтра*/
if ($('.side-filter').length) {
    var side_filter_top = $('.side-filter').offset().top;
    var side_filter_width = $('.side-filter').width();
    var side_filter_height = $('.side-filter').height();
    $('.side-filter').css('width', side_filter_width);

    function scroll_filter() {
        if ($(window).height() > side_filter_height && $(window).width() > 991) {
            if (!$('.side-filter').hasClass('fixed')) {
                side_filter_top = $('.side-filter:not(.fixed)').offset().top;
            }
            if ($(window).scrollTop() >= side_filter_top) {
                if (!$('.side-filter').hasClass('fixed')) {
                    $('.side-filter').addClass('fixed');
                    $('.side-filter').before('<div class="filter_shadow" style="height: ' + side_filter_height + 'px; width:' + side_filter_width + 'px "></div>');
                }
            } else {
                if ($('.side-filter').hasClass('fixed')) {
                    $('.side-filter').removeClass('fixed');
                    $('.filter_shadow').remove();
                }
            }
        }
    }
    $(document).resize(function () {
        scroll_filter();
    });
    $(document).scroll(function () {
        scroll_filter();
    });
    scroll_filter();
}
/*!скроллинг фильтра*/

$(document).ready(function () {
    $(document).on('click', '[data-scroll]', function () {
        var selector = $(this).attr('data-scroll');
        $('body').animate({scrollTop: $(selector).offset().top - 20}, 500);
        return false;
    });
    $(document).on('click', '.open_review', function () {
        $('[href="#tab2"]').click();
        return false;
    });
    function updateCart(data) {
        $(".cart-total").html(data.total);
        $(".cart-count").html(data.count);
        /*  if (data.discount_numeric) {
         $(".cart-discount").closest('tr').show();
         }
         $(".cart-discount").html('&minus; ' + data.discount);

         if (data.add_affiliate_bonus) {
         $(".affiliate").show().html(data.add_affiliate_bonus);
         } else {
         $(".affiliate").hide();
         }

         if (data.affiliate_discount) {
         $('.affiliate-discount-available').html(data.affiliate_discount);
         if ($('.affiliate-discount').data('use')) {
         $('.affiliate-discount').html('&minus; ' + data.affiliate_discount);
         }
         }*/
    }

    $('.dialog').on('click', 'a.dialog-close', function () {
        $(this).closest('.dialog').hide().find('.cart').empty();
        return false;
    });

    $(document).keyup(function (e) {
        if (e.keyCode == 27) {
            $(".dialog:visible").hide().find('.cart').empty();
        }
    });

    $(".content").on('submit', '.product-list form.addtocart', function () {
        var f = $(this);
        if (f.data('url')) {
            var d = $('#dialog');
            var c = d.find('.cart');
            c.load(f.data('url'), function () {
                c.prepend('<a href="#" class="dialog-close">&times;</a>');
                d.show();
                if ((c.height() > c.find('form').height())) {
                    c.css('bottom', 'auto');
                } else {
                    c.css('bottom', '15%');
                }
            });
            return false;
        }
        $.post(f.attr('action') + '?html=1', f.serialize(), function (response) {
            if (response.status == 'ok') {
                var cart_total = $(".cart-total");
                if ($(window).scrollTop() >= 35) {
                    cart_total.closest('#cart').addClass("fixed");
                }
                cart_total.closest('#cart').removeClass('empty');
                if ($("table.cart").length) {
                    $(".content").parent().load(location.href, function () {
                        cart_total.html(response.data.total);
                    });
                } else {
                    if (f.closest(".product-list").get(0).tagName.toLowerCase() == 'table') {
                        var origin = f.closest('tr');
                        var block = $('<div></div>').append($('<table></table>').append(origin.clone()));
                    } else {
                        var origin = f.closest('.block-item');
                        var block = $('<div class="main"><div class="content"><div class="content-pop-products">' + origin.html() + '</div></div></div>');
                    }
                    $('body').append(block);
                    block.css({
                        'z-index': 10,
                        top: origin.offset().top,
                        left: origin.offset().left,
                        width: origin.width() + 'px',
                        height: origin.height() + 'px',
                        position: 'absolute',
                        overflow: 'hidden'
                    }).animate({
                        top: cart_total.offset().top,
                        left: cart_total.offset().left,
                        width: 0,
                        height: 0,
                        opacity: 0.5
                    }, 500, function () {
                        $(this).remove();
                        updateCart(response.data);
                    });
                }
                if (response.data.error) {
                    alert(response.data.error);
                }
            } else if (response.status == 'fail') {
                alert(response.errors);
            }
        }, "json");
        return false;
    });

    function reset_button__active() {
        var active = 0;
        if ($('.filters.ajax input[type="checkbox"]:checked').length) {
            active = 1;
        }
        if (active) {
            $('#reset_filter').show();
        } else {
            $('#reset_filter').hide();
        }
    }

    reset_button__active();

    $('.filters.ajax form input').change(function () {
        reset_button__active();
        var f = $(this).closest('form');
        var url = '?' + f.serialize();
        $(window).lazyLoad && $(window).lazyLoad('sleep');
        $('#product-list').addClass('pointer_none');
        $.get(url + '&_=_', function (html) {
            var tmp = $('<div></div>').html(html);
            $('#product-list').html(tmp.find('#product-list').html());
            $('#product-list').removeClass('pointer_none');
            if (!!(history.pushState && history.state !== undefined)) {
                window.history.pushState({}, '', url);
            }
            $(window).lazyLoad && $(window).lazyLoad('reload');
        });
    });


    //LAZYLOADING
    if ($.fn.lazyLoad) {

        var paging = $('.lazyloading-paging');
        if (!paging.length) {
            return;
        }
        // check need to initialize lazy-loading
        var current = paging.find('li.selected');
        if (current.children('a').text() != '1') {
            return;
        }
        paging.hide();
        var loading_str = paging.data('loading-str') || 'Loading...';
        var win = $(window);

        // prevent previous launched lazy-loading
        win.lazyLoad('stop');

        // check need to initialize lazy-loading
        var next = current.next();
        if (next.length) {
            win.lazyLoad({
                container: '#main > .content',
                load: function () {
                    win.lazyLoad('sleep');

                    var paging = $('.lazyloading-paging').hide();

                    // determine actual current and next item for getting actual url
                    var current = paging.find('li.selected');
                    var next = current.next();
                    var url = next.find('a').attr('href');
                    if (!url) {
                        win.lazyLoad('stop');
                        return;
                    }

                    var product_list = $('#product-list .product-list');
                    var loading = paging.parent().find('.loading').parent();
                    if (!loading.length) {
                        loading = $('<div><i class="icon16 loading"></i>' + loading_str + '</div>').insertBefore(paging);
                    }

                    loading.show();
                    $.get(url, function (html) {
                        var tmp = $('<div></div>').html(html);
                        if ($.Retina) {
                            tmp.find('#product-list .product-list img').retina();
                        }
                        product_list.append(tmp.find('#product-list .product-list').children());
                        var tmp_paging = tmp.find('.lazyloading-paging').hide();
                        paging.replaceWith(tmp_paging);
                        paging = tmp_paging;

                        // check need to stop lazy-loading
                        var current = paging.find('li.selected');
                        var next = current.next();
                        if (next.length) {
                            win.lazyLoad('wake');
                        } else {
                            win.lazyLoad('stop');
                        }

                        loading.hide();
                        tmp.remove();
                    });
                }
            });
        }

    }
});
