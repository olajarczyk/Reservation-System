//Przeskrolowanie do interesującego elementu
function smoothScroll(element){
    document.querySelector(element).scrollIntoView(
        {
            behavior:'smooth'
        }
    );
}
window.onscroll = function(){
scroll();
}
function scroll(){
    if(document.body.scrollTop >30 || document.documentElement.scrollTop >30 ){
        document.getElementById('up-button').style.display="block";
    } else {
        document.getElementById('up-button').style.display="none";
    }
}

function scrollTop(){
    smoothScroll('header');
}

function reserve(car){
var select = document.getElementById('car');
var options_selected = select.querySelectorAll('option[selected');
options_selected.forEach(function(option){
    option.removeAttribute("selected");
});
var option = select.querySelector('option[value="'+car+'"]');
option.setAttribute("selected", "selected");
smoothScroll('#reservation');
}