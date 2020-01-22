import BigPicture from 'bigpicture'

window.addEventListener('load', function () {
    document.querySelectorAll('.zoomer').forEach(item => {
        item.addEventListener('click', e => {
            e.preventDefault();
            console.log(e.target.dataset.image)
            BigPicture({
                el: e.target,
                gallery: document.querySelectorAll('#profile-gallery .zoomer')
            })
        })
    });
    alert('fic');
    document.querySelector('.pe-portfolio__field').addEventListener('click', function (e) {
        BigPicture({
            el: e.target.closest('div[data-bp]'),
            gallery:this.querySelectorAll('.zoomer'),
        })
    });


    document.querySelectorAll('.zoomer-video').forEach(item => {
        item.addEventListener('click', e => {
            e.preventDefault();
            alert(e.target.dataset.video);
            console.log(e.target.dataset.video)
            BigPicture({
                el: e.target,
                iframeSrc:e.target.dataset.video
            })
        })
    })

    document.querySelectorAll('.catalog-card__media').forEach(item => {
        item.addEventListener('click', function (e) {
            BigPicture({
                el: e.target.closest('div[data-bp]'),
                gallery:item.querySelectorAll('.glide__slide-search'),
            })
        })
    })

});
