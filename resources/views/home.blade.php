<!DOCTYPE html>

<head>
    <title>Reels and Reads</title>
    <meta name = 'viewport' content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "{{url('css/stylesheet.css')}}" type='text/css'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f473dda5c.js" crossorigin="anonymous"></script>
    <script src="{{url('js/jquery-1.11.0.js')}}"></script>
    <script src="{{url('js/main.js')}}"></script>
    <script>
        var scrollAmount = 0;
        function sliderScrollLeft(idname){
            var sliders = document.querySelector(idname);
            sliders.scrollTo({top:0,left: (scrollAmount = scrollAmount - 180),behavior: "smooth"});
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
<body onresize="resizeAction()">
    <header class="primary-header flex">
        <div>
           <a href="home"><img src="{{url('images/logo_pink.png')}}" alt="logo" class="logo"></a>
        </div>
        <button class="mobile-nav-toggle" onclick=showToggle() style="background: transparent;">
            <div id="toggle-button">
                <i class="fa-solid fa-bars fa-2x"></i>
            </div>
        </button>
        <input type="text" placeholder="Search..." id="searchbar" bar-visible = 'false'>
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
                <li><a href="">
                    <span><i class="fa-solid fa-arrow-right-from-bracket"></i></span> Logout
                </a></li>
                <li><button onclick="displayBar()" style="background: transparent;">
                    <span id="searchbutton" button-visible = 'true' ><i class="fa-solid fa-magnifying-glass"></i></button></span>
                </a></li>
            </ul>
        </nav>
    </header>
    <!-- <?php   
        // include_once(".\config\config.php");
        // $username = 'test1'; //username has been hardcoded for now, we will get this from the session 
        // $movielist = mysqli_query($mysqli, "SELECT photoURL, title FROM items WHERE item_type = 'movie' and item_id IN (SELECT movie_id FROM movielist WHERE username = '$username')");
        // $booklist = mysqli_query($mysqli, "SELECT photoURL, title FROM items WHERE item_type = 'book' and item_id IN (SELECT book_id FROM booklist WHERE Username = '$username')");
        // $animelist = mysqli_query($mysqli, "SELECT photoURL, title FROM items WHERE item_type = 'anime' and item_id IN (SELECT anime_id FROM animelist WHERE Username = '$username')")
    ?> -->
    <main class = 'main-body'>
        <br><br><br><br><br><br><br>
        <div class='main-widget'>
            <div class = 'welcome'>
                <h1>Welcome Username</h1>
                <h3>We are keeping record of your favourite media!</h3>
            </div>
            <div id = 'movielist'>
                <h2>Movie List</h2>
                <div class = 'slider' id="movie-slider">
                    <button class="slider-button-left" onclick="sliderScrollLeft('#movie-slider')"><i class="fa-solid fa-angle-left"></i></button>
                    <button class="slider-button-right" onclick="sliderScrollRight('#movie-slider')"><i class="fa-solid fa-angle-right"></i></button>
                    @foreach ($movielist as $movie)
                    <a href="info?id={{$movie->title}}"><img src="{{$movie->photoURL}}" alt=""></a>
                    @endforeach
                </div>
            </div>
            <div id = 'booklist'>
                <h2>Book List</h2>
                <div class = 'slider' id="book-slider">
                    <button class="slider-button-left"  onclick="sliderScrollLeft('#book-slider')"><i class="fa-solid fa-angle-left"></i></button>
                    <button class="slider-button-right"  onclick="sliderScrollRight('#book-slider')"><i class="fa-solid fa-angle-right"></i></button>
                    @foreach ($booklist as $book)
                    <a href="info?id={{$book->title}}"><img src="{{$book->photoURL}}" alt=""></a>
                    @endforeach
                </div>
            </div>
            <div id = 'animelist'>
                <h2>Anime List</h2>
                <div class = 'slider' id="anime-slider">
                    <button class="slider-button-left" onclick="sliderScrollLeft('#anime-slider')" style="top:950px"><i class="fa-solid fa-angle-left"></i></button>
                    <button class="slider-button-right" onclick="sliderScrollRight('#anime-slider')" style="top:950px"><i class="fa-solid fa-angle-right"></i></button>
                    @foreach ($animelist as $anime)
                    <a href="info?id={{$anime->title}}"><img src="{{$anime->photoURL}}" alt=""></a>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</body>