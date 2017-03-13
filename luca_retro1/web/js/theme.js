/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
require([
    'jquery',
    'mage/smart-keyboard-handler',
    'mage/mage',
    'mage/ie-class-fixer',
    'domReady!'
], function ($, keyboardHandler) {
    'use strict';
    $(document).ready(function(){
        $('.cart-summary').mage('sticky', {
            container: '#maincontent'
        });

        $('.panel.header .header.links').clone().appendTo('#store\\.links');
    });
    keyboardHandler.apply();
});


require([
    'jquery'
], function ($) {
    $(document).ready(function(){
        if ($('#cms-about-us').length > 0){
            LoadPercCMS();
        }
        var windowScroll_t;
        $(window).scroll(function(){
            clearTimeout(windowScroll_t);
            windowScroll_t = setTimeout(function(){
                if(jQuery(this).scrollTop() > 100){
                    $('#toTop').fadeIn();
                }else{
                    $('#toTop').fadeOut();
                }
            }, 500);
        });
        $('#toTop').off("click").on("click",function(){
            $('html, body').animate({scrollTop: 0}, 600);
        });
    });
    function LoadPercCMS() {
        $('.cms-line').each(function() {
            var t = $(this);
            var dataperc = t.attr('id'), dataperc_int = dataperc.replace("a", ""), barperc = Math.round(dataperc_int);
            t.find('.cms-line-comp').animate({width: barperc + "%"}, dataperc_int * 25);
            t.find('.label').append('<div class="perc"></div>');
            function perc() {
                var t_length = parseInt($('.cms-line').css('width'));
                var length = t.find('.cms-line-comp').css('width'), perc_div = (parseInt(length) / t_length * 100), perc = Math.round(parseInt(perc_div)), labelpos = (100 - perc);
                t.find('.label').css('right', labelpos + '%');
                t.find('.perc').text(perc + '%');
            }
            perc();
            setInterval(perc, 0);
        });
    }
});