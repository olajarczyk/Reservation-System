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