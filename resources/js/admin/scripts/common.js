import $ from 'jquery';

let dataForm = document.querySelector('#data-form');
document.querySelectorAll('.send-data-form').forEach(item => {
    item.addEventListener('click', e => {
        e.preventDefault();
        dataForm.submit()
    });
});

$('#offer-message-block-btn').click(function () {
    $('#offer-message-block').slideToggle();
});
