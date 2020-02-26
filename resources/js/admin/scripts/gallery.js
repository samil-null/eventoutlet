import $ from 'jquery'
import 'magnific-popup';

$(document).ready(function() {
    if ($('.image-gallery').length) {
        $('.image-gallery').magnificPopup({type:'image'});
    }

    if ($('.video-gallery').length) {
        $('.video-gallery').magnificPopup({type:'iframe'});
    }

});
