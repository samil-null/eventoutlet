import $ from 'jquery'
import 'slick-carousel';

$(document).ready(function() {
    $('.algo-media').each(function (index, item) {
        $($(item).find('.algo-media__slider')).slick({
            dots: false,
            infinite: false,
            speed: 300,
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

    $(document).ready(function($) {
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: true,
            dots: false,
            asNavFor: '.slider-nav',
            prevArrow: $('.profile-slider__prev'),
            nextArrow: $('.profile-slider__next'),
            afterChange(info) {
                console.log(info)
            }
          });

          $('.slider-nav').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            arrows:false,
            focusOnSelect: true
          });

          $('#menuBtn').click(function() {
            $('#menuBody').toggleClass('show')
          });

          setTimeout(() => {
            let startBgImage = $('.slider-for').find('.slick-slide.slick-current img').attr('data-bg');
            $('#profile-slider-bg').css({
              'background-image': `url(${startBgImage})`
            });
          }, 0)

          $('.slider-for').on('beforeChange', function(event, slick, currentSlide, nextSlide){
            setTimeout(() => {
              let bgImage = $(this).find('.slick-slide.slick-current img').attr('data-bg');
              $('#profile-slider-bg').css({
                'background-image': `url(${bgImage})`
              });
            },0)

          });
    });

    $('.catalog-filter__preview').click(function(){
      $('.catalog-filter').toggleClass('show');
    });
});

