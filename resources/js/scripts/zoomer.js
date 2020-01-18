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
    })

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
});
