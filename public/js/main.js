
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


/* preferences code starts */
function handleBooksOptionClick(e) {
    e.preventDefault();
    const currentState = $('#books-selected').css('display');
    if (currentState === 'none') {
        $("#books-option").css("background", "#326280")
        $("#books-selected").show();
        $('#books-option').children(".option-name")[0].style = "color: white"
        const svgContent = $("#books-icon").children();
        for (let i = 0; i < svgContent.length; i++)
        {
            svgContent[i].attributes.fill.nodeValue = "white";
        }

    }
    else {
        $("#books-option").css("background", "rgba(255, 255, 255, 0.4")
        $("#books-selected").hide();
        $('#books-option').children(".option-name")[0].style = "color: #326280"
        const svgContent = $("#books-icon").children();
        for (let i = 0; i < svgContent.length; i++)
        {
            svgContent[i].attributes.fill.nodeValue = "#326280";
        }
    }   
}

function handleMoviesOptionClick(e) {
    e.preventDefault();
    const currentState = $('#movies-selected').css('display');
    if (currentState === 'none') {
        $("#movies-option").css("background", "#326280")
        $("#movies-selected").show();
        $('#movies-option').children(".option-name")[0].style = "color: white"
        const svgContent = $("#movies-icon").children();
        for (let i = 0; i < svgContent.length; i++)
        {
            svgContent[i].attributes.fill.nodeValue = "white";
        }
    }
    else {
        $("#movies-option").css("background", "rgba(255, 255, 255, 0.4")
        $("#movies-selected").hide();
        $('#movies-option').children(".option-name")[0].style = "color: #326280"
        const svgContent = $("#movies-icon").children();
        for (let i = 0; i < svgContent.length; i++)
        {
            svgContent[i].attributes.fill.nodeValue = "#326280";
        }
    }   
}

function handleAnimeOptionClick(e) {
    e.preventDefault();
    const currentState = $('#anime-selected').css('display');
    if (currentState === 'none') {
        $("#anime-option").css("background", "#326280")
        $("#anime-selected").show();
        $('#anime-option').children(".option-name")[0].style = "color: white"
    }
    else {
        $("#anime-option").css("background", "rgba(255, 255, 255, 0.4")
        $("#anime-selected").hide();
        $('#anime-option').children(".option-name")[0].style = "color: #326280"
    }
}

function handleBooksOptionHoverIn(e) {
    $("#books-option").css("background", "#326280")
    $('#books-option').children(".option-name")[0].style = "color: white"
    const svgContent = $("#books-icon").children();
    for (let i = 0; i < svgContent.length; i++)
    {
        svgContent[i].attributes.fill.nodeValue = "white";
    }
}

function handleBooksOptionHoverOut(e) {
    e.preventDefault();
    if ($("#books-selected").css("display") === 'none')
    {
        $("#books-option").css("background", "rgba(255, 255, 255, 0.4")
        $('#books-option').children(".option-name")[0].style = "color: #326280"
        const svgContent = $("#books-icon").children();
        for (let i = 0; i < svgContent.length; i++)
        {
            svgContent[i].attributes.fill.nodeValue = "#326280";
        }
    }
}

function handleMoviesOptionHoverIn(e) {
    e.preventDefault();
    $("#movies-option").css("background", "#326280")
    $('#movies-option').children(".option-name")[0].style = "color: white"
    const svgContent = $("#movies-icon").children();
    for (let i = 0; i < svgContent.length; i++)
    {
        svgContent[i].attributes.fill.nodeValue = "white";
    }
}

function handleMoviesOptionHoverOut(e) {
    e.preventDefault();
    if ($("#movies-selected").css("display") === 'none') {
        $("#movies-option").css("background", "rgba(255, 255, 255, 0.4")
        $('#movies-option').children(".option-name")[0].style = "color: #326280"
        const svgContent = $("#movies-icon").children();
        for (let i = 0; i < svgContent.length; i++)
        {
            svgContent[i].attributes.fill.nodeValue = "#326280";
        }
    }
}

function handleAnimeOptionHoverIn(e) {
    e.preventDefault();
    $("#anime-option").css("background", "#326280")
    $('#anime-option').children(".option-name")[0].style = "color: white"
}

function handleAnimeOptionHoverOut(e) {
    e.preventDefault();
    if ($("#anime-selected").css('display') === 'none') {
        $("#anime-option").css("background", "rgba(255, 255, 255, 0.4")
        $('#anime-option').children(".option-name")[0].style = "color: #326280"
    }
}

function addGenre(e) {
    e.preventDefault();
    const selectedGenre = $("#genres option:selected").text();
    const genreVal = $("#genres option:selected").val();
    if ($("#no-genre").css('display') !== 'none')
        $('#no-genre').css('display', 'none');
    let newGenre = "<div class='selected-genre'>";
    newGenre += "<div class='genre-name' value=" + genreVal + ">" + selectedGenre + "</div>";
    newGenre += "<div class='genre-delete-container'>";
    newGenre += "<button class='genre-delete'><img src='../images/DeleteIcon.svg'></button>";
    newGenre += "</div>";
    newGenre += "</div>";
    $("#selected-genres").append(newGenre);
}

function deleteGenre(e) {
    e.preventDefault();
    const clickedButton = e.currentTarget;
    clickedButton.parentElement.parentElement.remove();
    if($("#selected-genres").children().length === 1)
        $("#no-genre").show();
}

function handleNextClick(e) {
    e.preventDefault();
    const carousel = $(".main-carousel").data('flickity');
    const selectedIndex = carousel.selectedIndex
    if (selectedIndex === 1)
    {
        console.log("Submit");
        let selectedGenres = [];
        let selectedGenreIDs = [];
        let books=0, movies=0, anime=0;
        let _token   = $('meta[name="csrf-token"]').attr('content');
        const genres = $("#selected-genres").children();
        if (genres.length > 1) {
            for (let i = 1; i < genres.length; i++)
            {
                selectedGenres.push(genres[i].children[0].innerText);
                selectedGenreIDs.push(genres[i].children[0].getAttribute('value'));
            } 
        }
        if ($("#books-selected").css("display") !== "none")
            books = 1;
        if ($("#movies-selected").css("display") !== "none")
            movies = 1;
        if ($("#anime-selected").css("display") !== "none")
            anime = 1;
        console.log(books, movies, anime);
        $.ajax({
            url: '/preferences',
            method: 'POST',
            data: {
                selectedGenres,
                selectedGenreIDs,
                books,
                movies,
                anime,
                _token
            },
            success: function(response) {
                console.log(response);
                window.location.pathname = response.redirectURL;
            },
            error: function(error) {
                console.log(error);
            }
        })
    }
    else
    {
        $("#prev-button").show();
        $(".page-heading")[0].textContent = "Choose your preferred genres";
        $(".main-carousel").flickity('next', false, false);
    }
}

function handlePrevClick(e) {
    e.preventDefault();
    $("#prev-button").hide();
    $(".page-heading")[0].textContent = "Choose your preferred content";
    $(".main-carousel").flickity('previous', false, false);
}