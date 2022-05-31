<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reels and Reads</title>
    <meta name = 'viewport' content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href= "{{url('css/stylesheet.css')}}" type='text/css'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f473dda5c.js" crossorigin="anonymous"></script>
    <script src="{{url('js/jquery-1.11.0.js')}}"></script>
    <script src="{{url('js/main.js')}}"></script>
    
    <style>
        .fa-bars, .fa-xmark{
            color: white;
        }
    </style>
</head>
<body>
    <header class="primary-header flex">
        <div>
           <a href="home"><img src="{{url('images/logo_pink.png')}}" alt="logo" class="logo"></a>
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
                <li><a href="">
                    <span><i class="fa-solid fa-arrow-right-from-bracket"></i></span> Logout
                </a></li>
                <li><button onclick="displayBar()" style="background: transparent;">
                    <span id="searchbutton" button-visible = 'true' ><i class="fa-solid fa-magnifying-glass"></i></button></span>
                </a></li>
            </ul>
        </nav>
    </header>
    <main class="search-main">
        <br><br><br><br><br><br>
        <div class="main-widget">
            @foreach ($list as $i)
            <div id="info-widget" class='searchinfo'>
                <div>
                    <a href="info?id={{$i->title}}"><img src="{{$i->photoURL}}" alt="" style = 'height:200px;width:160px;'></a>
                </div>
                <div>
                    <table>
                        <tr><td>Title: {{$i->title}}</td></tr>
                        <tr><td>Ratings: {{$i->online_ratings}}</td></tr>
                        <tr><td>Year of Release: {{$i->yearOfRelease}}</td></tr>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
    </main>
</body>
</html>