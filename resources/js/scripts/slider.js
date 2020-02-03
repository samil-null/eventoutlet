import $ from 'jquery'
import 'slick-carousel';

$(document).ready(function() {
    $('.algo-media').each(function (index, item) {
        $($(item).find('.algo-media__slider')).slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            prevArrow: $(item).find('.algo-media__prev-slide'),
            nextArrow: $(item).find('.algo-media__next-slide')
        });
    });
});

