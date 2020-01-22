import Glide from '@glidejs/glide'

window.addEventListener('load', function () {
    let sliders = document.querySelectorAll('.glide');

    for (let i = 0; i < sliders.length; i++) {
        new Glide(sliders[i], {
            type: 'carousel',
            startAt: 0,
            perView: 4,
            arrows: true
        }).mount();
    }
});

