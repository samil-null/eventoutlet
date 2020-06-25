import $ from 'jquery'
import 'slick-carousel';
import Vue from 'vue'
import '../scripts/header';
import '../scripts/zoomer';
import AuthForm from "../app/components/Auth/AuthForm";
import UserCalendar from "../app/components/Datepickers/UserCalendar";
import Feedback from '../app/components/Feedback';
import Oferta from '../app/components/Oferta';
import OffersListDatePicker from '../app/components/Datepickers/OffersListDatePicker';
import 'simplebar';


new Vue({
    el:'#app',
    components: {
        AuthForm,
        UserCalendar,
        Feedback,
        Oferta,
        OffersListDatePicker
    }
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
      });

      $('.slider-nav').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        arrows:false,
        focusOnSelect: true
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
