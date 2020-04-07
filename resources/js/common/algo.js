import $ from 'jquery'
import 'slick-carousel';
import BigPicture from 'bigpicture'

$(document).ready(function() {
    $('.algo-media').each(function (index, item) {
        $($(item).find('.algo-media__slider')).slick({
            dots: false,
            infinite: false,
            speed: 500,
            slidesToShow: 4,
            slidesToScroll: 1,
            prevArrow: $(item).find('.algo-media__prev-slide'),
            nextArrow: $(item).find('.algo-media__next-slide'),
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });

    document.querySelectorAll('.catalog-card__media').forEach(item => {
        item.addEventListener('click', function (e) {
            BigPicture({
                el: e.target.closest('li[data-bp]'),
                gallery:item.querySelectorAll('.glide__view'),
            })
        })
    });
})