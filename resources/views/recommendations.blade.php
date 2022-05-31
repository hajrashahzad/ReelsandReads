<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "{{url('css/stylesheet.css')}}" type='text/css'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f473dda5c.js" crossorigin="anonymous"></script>
    <script src="{{url('js/jquery-1.11.0.js')}}"></script>
    <script src="{{url('js/main.js')}}"></script>
    <title>Document</title>
    <script>
        var scrollAmount = 0;
        function sliderScrollLeft(idname){
            var sliders = document.querySelector(idname);
            sliders.scrollTo({top:0, left: (scrollAmount = scrollAmount - 180),behavior: "smooth"});
            if(scrollAmount < 0){
                scrollAmount = 0;
            }
            return;
        }
        function sliderScrollRight(idname){
            var sliders = document.querySelector(idname);
            if(scrollAmount <= sliders.scrollWidth - sliders.clientWidth){
                sliders.scrollTo({top:0,left: (scrollAmount = scrollAmount + 180),behavior: "smooth"});
            }
            return;
        }
    </script>
    <style>
        .fa-bars, .fa-xmark{
            color: white;
        }
    </style>
</head>
<body>
    <header class="primary-header flex">
        <div>
           <a href="home"><img src="/images/logo_pink.png" alt="logo" class="logo"></a>
        </div>
        <button class="mobile-nav-toggle" onclick=showToggle() style="background: transparent;">
            <div id="toggle-button">
                <i class="fa-solid fa-bars fa-2x"></i>
            </div>
        </button>
        <form action="search" method ='POST'>
            @csrf
            <input type="text" placeholder="Search..." name= 'searchbar' id="searchbar" bar-visible = 'false'>
            <input type="submit" style='display:none;'>
        </form>
        <nav>
            <ul id = "primary-navigation" data-visible="false" class="primary-navigation flex">
                <li><a href="home">
                    <span><i class="fa-solid fa-house"></i></span> Home
                </a></li>
                <li><a href="recommendations">
                    <span><i class="fa-solid fa-tablet"></i></span> Recommendations
                </a></li>
                <li><a href="">
                    <span><i class="fa-solid fa-gear"></i></span> Settings
                </a></li>
                <li><a href="logout">
                    <span><i class="fa-solid fa-arrow-right-from-bracket"></i></span> Logout
                </a></li>
                <li><button onclick="displayBar()" style="background: transparent;">
                    <span id="searchbutton" button-visible = 'true' ><i class="fa-solid fa-magnifying-glass"></i></button></span>
                </a></li>
            </ul>
        </nav>
    </header>
    <main class="rec-main">
        <br><br><br><br><br><br><br>
        <div class="main-widget">
            <h2>Movies for you</h2>
            <div class="slider" id="rec-slider1">
                <button class="slider-button-left"  onclick="sliderScrollLeft('#rec-slider1')" style="top:180px"><i class="fa-solid fa-angle-left"></i></button>
                <button class="slider-button-right"  onclick="sliderScrollRight('#rec-slider1')" style="top:180px"><i class="fa-solid fa-angle-right"></i></button>
                @foreach ($movielist as $movie)
                <a href="info?id={{$movie->title}}"><img src="{{$movie->photoURL}}" alt=""></a>
                @endforeach
              
            </div>
        </div>
        <div class="main-widget">
            <h2>Books for you</h2>
            <div class="slider" id="rec-slider2">
                <button class="slider-button-left"  onclick="sliderScrollLeft('#rec-slider2')" style="top:180px"><i class="fa-solid fa-angle-left"></i></button>
                <button class="slider-button-right"  onclick="sliderScrollRight('#rec-slider2')"style="top:180px"><i class="fa-solid fa-angle-right"></i></button>
                @foreach ($booklist as $book)
                    <a href="info?id={{$book->title}}"><img src="{{$book->photoURL}}" alt=""></a>
                @endforeach
            </div>
        </div>
        <div class="main-widget">
            <h2>Animes for you</h2>
            <div class="slider" id="rec-slider3">
                <button class="slider-button-left"  onclick="sliderScrollLeft('#rec-slider3')" style="top:180px"><i class="fa-solid fa-angle-left"></i></button>
                <button class="slider-button-right"  onclick="sliderScrollRight('#rec-slider3')"style="top:180px"><i class="fa-solid fa-angle-right"></i></button>
                @foreach ($animelist as $anime)
                    <a href="info?id={{$anime->title}}"><img src="{{$anime->photoURL}}" alt=""></a>
                @endforeach
            </div>
        </div>
        <div class="main-widget">
            <h2>Our Favourites</h2>
            <div class="slider" id="rec-slider4">
                <button class="slider-button-left"  onclick="sliderScrollLeft('#rec-slider4')" style="top:180px"><i class="fa-solid fa-angle-left"></i></button>
                <button class="slider-button-right"  onclick="sliderScrollRight('#rec-slider4')"style="top:180px"><i class="fa-solid fa-angle-right"></i></button>
                <img src="https://cdn.shopify.com/s/files/1/0057/3728/3618/products/wandavision.mp_240x360_crop_center.progressive.jpg?v=1614371756" alt="">
                <img src="data:image/jpeg;base64,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" alt="">
                <img src="https://www.washingtonpost.com/graphics/2019/entertainment/oscar-nominees-movie-poster-design/img/black-panther-web.jpg" alt="">
                <img src="https://cdn.shopify.com/s/files/1/1878/8625/products/xl23guardiansofthegalaxyptr11251401_580x.jpg?v=1554171679" alt="">
                <img src="https://i.ebayimg.com/images/g/39wAAOSweZJaGXk2/s-l400.jpg" alt="">
                <img src="https://media1.popsugar-assets.com/files/thumbor/z5oKgNC9S4DS6Bay78Aoy5aLO4s/fit-in/728xorig/filters:format_auto-!!-:strip_icc-!!-/2017/01/26/813/n/1922283/055dc333c3280d59_BeautyAndTheBeast58726d5b9fac8/i/Beauty-Beast-2017-Movie-Posters.jpg" alt="">
                <img src="https://collider.com/wp-content/uploads/2017/06/us-poster.jpg" alt="">
                <img src="https://www.ubuy.com.pk/productimg/?image=aHR0cHM6Ly9tLm1lZGlhLWFtYXpvbi5jb20vaW1hZ2VzL0kvNzFIQk9PN3RZNUwuX0FDX1NMMTUwMF8uanBn.jpg" alt="">
                <img src="https://images.fandango.com/ImageRenderer/0/0/redesign/static/img/default_poster.png/0/images/masterrepository/other/ant_man_ver5.jpg" alt="">
                <img src="https://www.washingtonpost.com/graphics/2019/entertainment/oscar-nominees-movie-poster-design/img/bohemian-rhapsody-web.jpg" alt="">
                <img src="https://www.digitalartsonline.co.uk/cmsdata/slideshow/3662115/star-wars-last-jedi-poster.jpg" alt="">
            </div>
        </div>
    </main>
</body>
</html>