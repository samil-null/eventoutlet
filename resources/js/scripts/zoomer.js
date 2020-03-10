import BigPicture from 'bigpicture'


window.addEventListener('load', function () {

    document.querySelectorAll('.zoomer').forEach(item => {
        item.addEventListener('click', e => {
            e.preventDefault();
            BigPicture({
                el: this,
                gallery: document.querySelectorAll('#profile-gallery .zoomer')
            })
        })
    });

    let gallery1 = document.querySelector('.pe-portfolio__field');
    if (gallery1) {
        document.querySelector('.pe-portfolio__field').addEventListener('click', function (e) {
            BigPicture({
                el: e.target.closest('div[data-bp]'),
                gallery:this.querySelectorAll('.zoomer'),
            })
        });
    }



    document.querySelectorAll('.zoomer-video').forEach(item => {
        item.addEventListener('click', e => {
            e.preventDefault();
            let video  = e.target.closest('div[data-video]');
            BigPicture({
                el: video,
                iframeSrc: video.dataset.video
            })
        })
    });

    document.querySelectorAll('.catalog-card__media').forEach(item => {
        console.log(item);
        item.addEventListener('click', function (e) {

            BigPicture({
                el: e.target.closest('li[data-bp]'),
                gallery:item.querySelectorAll('.glide__view'),
            })
        })
    })

    $('.catalog-filter__preview').click(function(){
      $('.catalog-filter').toggleClass('show');
    });
});
