import $ from 'jquery';

window.addEventListener('load', function () {
    let profileBlock = document.querySelector('.navbar-general__profile-body');
    if (profileBlock) {
        profileBlock.addEventListener('click', function () {
            this.classList.toggle('show');
        })
    }

    $('#menuBtn').click(function() {
        $('#menuBody').toggleClass('show')
    });
});

