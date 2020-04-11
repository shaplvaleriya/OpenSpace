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

console.log(urlPage);
if(urlPage == 'reg'){
   document.getElementById('signInModal').style.display = "none";
}
document.getElementById(urlPage).classList.add('current');



