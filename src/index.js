import './style.css';

jQuery( document ).ready( function( $ ) {

    console.log('Разработано https://shibitov.ru');

    $('#faq-screen .question').click(function() {
        $(this).toggleClass('shown').find('content').slideToggle('fast');
    });

    $(document).on('click', 'a[href^="#"]', function (event) {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top
        }, 500);
    });

});