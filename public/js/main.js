
function showToggle(){
    const primaryNav = document.querySelector(".primary-navigation");
    const visibility = primaryNav.getAttribute('data-visible');
    var btn = document.getElementsByClassName('mobile-nav-toggle');
    if(visibility == 'false'){
        primaryNav.setAttribute('data-visible', true); 
        document.getElementById('toggle-button').innerHTML = '<i class="fa-solid fa-xmark fa-2x"></i>';
    }
    else if (visibility == 'true'){
        primaryNav.setAttribute('data-visible', false); 
        document.getElementById('toggle-button').innerHTML = '<i class="fa-solid fa-bars fa-2x"></i>';
    }
}
var width = window.innerWidth;
const searchbutton = document.querySelector("#searchbutton");
var searchbuttonVisibilty = searchbutton.getAttribute('button-visible');
$(document).ready(function(){
    if(width>557){
        searchbuttonVisibilty.setAttribute('button-visible', true);
    }
    else if(width <= 557){
        searchbuttonVisibilty.setAttribute('button-visible', false);
    }
});
function resizeAction(){
    width = window.innerWidth;
    if(width>557){
        searchbuttonVisibilty.setAttribute('button-visible', true);
    }
    else if(width <= 557){
        searchbuttonVisibilty.setAttribute('button-visible', false);
    }
}
function displayBar(){
    const bar = document.querySelector("#searchbar");
    const barVisibility = bar.getAttribute("bar-visible");
    if(barVisibility == 'true'){
        bar.setAttribute('bar-visible', false)
    }
    else if (barVisibility == 'false'){
        bar.setAttribute('bar-visible', true);
    }
}

