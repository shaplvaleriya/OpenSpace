// window.onscroll = function() {myFunction()};

// function myFunction() {
//   if(window.pageYOffset > 80){
//   	document.getElementById('hed').setAttribute(
//    "style", "background: linear-gradient(0.5turn, rgba(118, 64, 152, 0.8), rgba(33, 64, 154, 0.01));");
// }else{
// 	document.getElementById('hed').setAttribute(
//    "style", "background: none;");
// }
// }

var url = location.pathname;
var urlPage = url.substr(url.lastIndexOf('/') + 1);
urlPage = urlPage.substr(0, urlPage.indexOf('.'))

if (urlPage == 'reg') {
   document.getElementById('signInModal').style.display = "none";
}
else if(urlPage !== 'poster'){
   $('#search-form').css('display', 'none');
}
document.getElementById(urlPage).classList.add('current');



$('.search-box').hover(() => {
   $('.search-box').css('width', '173px');
   $('.search-txt').css('width', '160px');
   $('.search-txt').css('padding', '0 6px');
   $('.search-btn').css('background', '-webkit-gradient(linear, left top, right top, from(#764098), to(#21409A))');
   $('.search-btn').css('background', 'linear-gradient(0.25turn, #764098, #21409A)');
}, () => {
   if (!$("#search-input").is(":focus")) {
      $('#search-form').css('width', '30px');
      $('.search-box').css('width', '20px');
      $('.search-txt').css('width', '0px');
      $('.search-txt').css('padding', '0');
      $('.search-btn').css('background', 'black');
   }
})

$('#search-input').focus(() => {
   $('.search-box').css('width', '173px');
   $('.search-txt').css('width', '160px');
   $('.search-txt').css('padding', '0 6px');
   $('.search-btn').css('background', '-webkit-gradient(linear, left top, right top, from(#764098), to(#21409A))');
   $('.search-btn').css('background', 'linear-gradient(0.25turn, #764098, #21409A)');
})

$('#search-input').blur(() => {
   $('#search-form').css('width', '30px');
   $('.search-box').css('width', '20px');
   $('.search-txt').css('width', '0px');
   $('.search-txt').css('padding', '0');
   $('.search-btn').css('background', 'black');
})