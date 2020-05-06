$(document).ready(function () {
    var viewportWidth = $(window).width();
    if (viewportWidth <= 768) {
        $('#signInModal').removeClass('pater');
        $('.nav-content').css('margin-left','-320px');
        $('#signInModal').append("ВОЙТИ")
    }else if (viewportWidth >= 768){
        $('#signInModal').addClass('pater')
        $('.nav-content').css('margin-left','0');
    }
    
    $(".hamburger").click(function () {
        $(this).toggleClass("is-active");
        if(document.getElementById('hamburger-1').classList[1]) {
            $('.nav-content').animate({
                marginLeft: '-70px'
            }, 400, () => {})
        } else {
            $('.nav-content').animate({
                marginLeft: '-320px'
            }, 400, () => {})
        }
    });
});

$(window).resize(function () {
    var viewportWidth = $(window).width();
    if (viewportWidth <= 768) {
        $('#signInModal').removeClass('pater');
        $('.nav-content').css('margin-left','-320px');
        if(!$('#signInModal').children().prevObject['0'].innerText){
            $('#signInModal').append("ВОЙТИ")
        }
    }else if (viewportWidth >= 768){
        $('#signInModal').addClass('pater')
        $('.nav-content').css('margin-left','0');
        $('#signInModal').children().prevObject['0'].childNodes['7'].textContent = ''
        $('#signInModal').children().prevObject['0'].childNodes['8'].textContent = ''
    }
});