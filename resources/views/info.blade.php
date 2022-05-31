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
    <script>
        $(document).ready(function(){
            $('#add-button').click(function(){
                const id = $("#add-button").attr("value");
                console.log(id);
                let _token   = $('meta[name="csrf-token"]').attr('content');
               $.ajax({
                   url: '/info',
                   method: 'POST',
                   data: {itemID: id, addClick:true, _token: _token},
                   success: function(response) {
                       console.log(response),
                       $('#success-message').html('Added Successfully');
                       $('#success-message').show();
                    },
                    error: function(error) {console.log(error)}
               })
           });
           $('#remove-button').click(function(){
                const id = $("#add-button").attr("value");
                console.log(id);
                let _token   = $('meta[name="csrf-token"]').attr('content');
               $.ajax({
                   url: '/info',
                   method: 'POST',
                   data: {itemID: id, addClick:false, _token: _token},
                   success: function(response) {
                       console.log(response);
                       $('#success-message').html('Removed Successfully');
                       $('#success-message').show();
                    },
                    error: function(error) {console.log(error)}
               })
           });
        })
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
    <main>
        <br><br><br><br><br><br>
        <div class="main-widget" >
            <h2 id="media-title">{{$title}}</h2>
            <div id="info-widget">
                <div>
                    <img src="{{$photoURL}}" alt="">
                </div>
               <div>
                @if($item_type == 'movie')
                <table>
                    <tr>
                      <td>Ratings: {{$ratings}}</td>
                    </tr>
                    <tr>
                        <td>Year of Release:  {{$yearOfRelease}}</td>
                    </tr>
                    <tr>
                       <td>Cast: {{$cast}}</td>
                    </tr>
                    <tr>
                        <td>Director: {{$director}}</td>
                    </tr>
                    <tr>
                        <td>Genres: {{$genres}}</td>
                    </tr>
                    <tr>
                        <td>Sypnosis: {{$sypnosis}}</td>
                    </tr>
                    <tr>
                        <td>Runtime: {{$runtime}}</td>
                    </tr>
                  </table>
                  @elseif($item_type == 'book')
                  <table>
                    <tr>
                      <td>Ratings: {{$ratings}}</td>
                    </tr>
                    <tr>
                        <td>Year of Release:  {{$yearOfRelease}}</td>
                    </tr>
                    <tr>
                       <td>Authors: {{$authors}}</td>
                    </tr>
                    <tr>
                        <td>Tags: {{$tags}}</td>
                    </tr>
                    <tr>
                        <td>ISBN: {{$isbn}}</td>
                    </tr>
                    <tr>
                        <td>Number of Pages: {{$pgs}}</td>
                    </tr>
                  </table>
                  @elseif($item_type == 'anime')
                  <table>
                    <tr>
                      <td>Ratings: {{$ratings}}</td>
                    </tr>
                    <tr>
                        <td>Year of Release:  {{$yearOfRelease}}</td>
                    </tr>
                    <tr>
                       <td>Genres: {{$genres}}</td>
                    </tr>
                    <tr>
                        <td>Rank: {{$rank}}</td>
                    </tr>
                    <tr>
                        <td>Japanese Title: {{$og_title}}</td>
                    </tr>
                    <tr>
                        <td>Overview: {{$overview}}</td>
                    </tr>
                    <tr>
                        <td>Number Of Episodes: {{$eps}}</td>
                    </tr>
                  </table>
                  @endif
               </div>
            </div>
            <div id="list-button" >
               <button class="add-to-list-button" id='add-button' value = "{{$itemID}}"> Add to List</button>
               <button class='remove-from-list-button' id = 'remove-button' value = "{{$itemID}}"> Remove from List</button>
               <p id='success-message'></p>
            </div>
            <br><br>
            <form id="ratings-form" action="">
                <h3 id="rate-heading">Rate the movie!</h2>
                    <div class="ratings-box">
                        <div class='ratings-radio'>
                            <input type="radio" id="radio1">
                            <label for="radio1">1</label>
                        </div>
                        <div class='ratings-radio'>
                            <input type="radio" id="radio2">
                            <label for="radio2">2</label>
                        </div>
                        <div class='ratings-radio'>
                            <input type="radio" id="radio3">
                            <label for="radio3">3</label>
                        </div>
                        <div class='ratings-radio'>
                            <input type="radio" id="radio4">
                            <label for="radio4">4</label>
                        </div>
                        <div class='ratings-radio'>
                            <input type="radio" id="radio5">
                            <label for="radio5">5</label>
                        </div>
                        <div class='ratings-radio'>
                            <input type="radio" id="radio6">
                            <label for="radio6">6</label>
                        </div>
                        <div class='ratings-radio'>
                            <input type="radio" id="radio7">
                            <label for="radio7">7</label>
                        </div>
                        <div class='ratings-radio'>
                            <input type="radio" id="radio8">
                            <label for="radio8">8</label>
                        </div>
                        <div class='ratings-radio'>
                            <input type="radio" id="radio9">
                            <label for="radio9">9</label>
                        </div>
                        <div class='ratings-radio'>
                            <input type="radio" id="radio10">
                            <label for="radio10">10</label>
                        </div>
                    </div>
                    <br>
                    <h3>Your thoughts?</h3>
                    <br>
                    <input type="text" id="rate-comments" placeholder="Leave a review....">
                    <button class="submit-button" type="submit"> Submit</button>
            </form>

        </div>
        <div>
            
        </div>
    </main>
</body>