$(function() {
    $('footer').footerReveal();
});
$(function() {
    $('section.about a').click(function() {
        $('html, body').animate({scrollTop: $(document).height()}, 2000);
        return false;
    });
});