import $ from 'jquery'
import 'magnific-popup';
import BigPicture from "bigpicture";


$(document).ready(function() {
    if ($('.image-gallery').length) {
        $('.image-gallery').magnificPopup({type:'image'});
    }

    // if ($('.video-gallery').length) {
    //     $('.video-gallery').magnificPopup({type:'iframe'});
    // }


    let videoLoaderBlock = document.querySelector('.admin-gallery_video');

    if (videoLoaderBlock) {
        videoLoaderBlock.addEventListener('click', function(e) {
            e.preventDefault();
            let video  = e.target.closest('a[data-video]');

            if (video) {
                BigPicture({
                    el: video,
                    iframeSrc: video.dataset.video
                })
            }

        });
    }
});
