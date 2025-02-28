import './style.css';

new WOW().init();

jQuery('.content-wrapper').find('section, h2, h3, h1, p, li, .row, .row div, img').addClass('wow fadeIn');

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

    $('body:not(.home) ').find('a[href^="#"]').each(function() {
        $(this).attr('href','/' + $(this).attr('href'));
    });

    $('#form-toggler').click(() => {
        $('.submit-form-container').fadeIn('fast');
        $('body').addClass('no-overflow');
    });

    $('.closer, .close-button').click(() => {
        $('.submit-form-container').fadeOut('fast');
        $('body').removeClass('no-overflow');
    });

    let i = 0;
    $('.single .article-body').find('.wp-block-heading').each(function() {
        if ($(this).get(0).tagName === 'H2') {
            i++;
            $(this).attr('id', 'heading' + i);
            $('.article-index .article-index-content').append('<p class="first_level"><a href="#heading' + i + '">' + $(this).text() + '</p>');
        }
    });

    if ($('.article-index .article-index-content .first_level').length === 0) {
        $('.article-index').detach();
    }

    $('#handheld_menu_toggler').click(() => {
        $('.handheld_menu').slideDown('fast');
    });

    $('#handheld_menu_closer').click(() => {
        $('.handheld_menu').slideUp('fast');
    });

    $('.handheld_menu').find('a').click(() => {
        $('.handheld_menu').slideUp('fast');
    });
});