<head>
    <title>Reels and Reads</title>
    <meta name = 'viewport' content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href= "{{url('css/stylesheet.css')}}" type='text/css'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f473dda5c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
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
                    error: function(error) {
                        console.log(error),
                        $('#success-message').html('Item already in list!');
                        $('#success-message').show();
                    }
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
                    error: function(error) {
                        console.log(error),
                        $('#success-message').html('Item not in list!');
                       $('#success-message').show();
                    }
               })
           });

           $("#add-review").click(function(e) {
               e.preventDefault();
               let _token   = $('meta[name="csrf-token"]').attr('content');
               const id = $("#add-button").attr("value");
               const review = $("#rate-comments").val();
               const stars = $(".form-check-input");
               let star;
               for (let i = 0; i < stars.length; i++)
               {
                   if (stars[i].checked)
                        star = stars[i].value;
               }
               $.ajax({
                    url: "/save-review",
                    method: 'POST',
                    data: {
                        itemId: id,
                        star,
                        review,
                        _token
                    },
                    success: function(response) {console.log(response)},
                    error: function() {console.log(error)}
               })
               $("#rate-comments").val("")
               stars[star - 1].checked = false;
           })
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
                <li><a href="logout">
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
            <div id="info-widget" class='infopg'>
                <div>
                    <img src="{{$photoURL}}" alt="">
                </div>
               <div>
                @if($item_type == 'movie')
                <table>
                    <tr>
                      <td><b>Ratings: </b> {{$ratings}}</td>
                    </tr>
                    <tr>
                        <td><b>Year of Release: </b> {{$yearOfRelease}}</td>
                    </tr>
                    <tr>
                       <td><b>Cast:</b> {{$cast}}</td>
                    </tr>
                    <tr>
                        <td><b>Director:</b> {{$director}}</td>
                    </tr>
                    <tr>
                        <td><b>Genres:</b> {{$genres}}</td>
                    </tr>
                    <tr>
                        <td><b>Sypnosis:</b> {{$sypnosis}}</td>
                    </tr>
                    <tr>
                        <td><b>Runtime:</b> {{$runtime}}</td>
                    </tr>
                  </table>
                  @elseif($item_type == 'book')
                  <table>
                    <tr>
                      <td><b> Ratings:</b> {{$ratings}}</td>
                    </tr>
                    <tr>
                        <td><b>Year of Release: </b> {{$yearOfRelease}}</td>
                    </tr>
                    <tr>
                       <td><b>Authors:</b> {{$authors}}</td>
                    </tr>
                    <tr>
                        <td><b>Tags:</b> {{$tags}}</td>
                    </tr>
                    <tr>
                        <td><b>ISBN:</b> {{$isbn}}</td>
                    </tr>
                    <tr>
                        <td><b>Number of Pages:</b> {{$pgs}}</td>
                    </tr>
                  </table>
                  @elseif($item_type == 'anime')
                  <table>
                    <tr>
                      <td><b>Ratings: </b>{{$ratings}}</td>
                    </tr>
                    <tr>
                        <td><b>Year of Release: </b> {{$yearOfRelease}}</td>
                    </tr>
                    <tr>
                       <td><b>Genres:</b> {{$genres}}</td>
                    </tr>
                    <tr>
                        <td><b>Rank:</b> {{$rank}}</td>
                    </tr>
                    <tr>
                        <td><b>Japanese Title:</b> {{$og_title}}</td>
                    </tr>
                    <tr>
                        <td><b>Overview:</b> {{$overview}}</td>
                    </tr>
                    <tr>
                        <td><b>Number Of Episodes:</b> {{$eps}}</td>
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
            <form id="ratings-form">
                <h3 id="rate-heading">Rate the movie!</h2>

                    <!-- <div class="ratings-box">
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
                    </div> -->
                <div class="ratings-box">
                    <div class="form-check form-check-inline" id = 'ratings-radio'>
                        <input class="form-check-input" type="radio" name="Options" id="inlineRadio1" value="1">
                        <label class="form-check-label" for="inlineRadio1">1</label>
                     </div>
                    <div class="form-check form-check-inline" id = 'ratings-radio'>
                        <input class="form-check-input" type="radio" name="Options" id="inlineRadio2" value="2">
                        <label class="form-check-label" for="inlineRadio2">2</label>
                    </div>
                    <div class="form-check form-check-inline" id = 'ratings-radio'>
                        <input class="form-check-input" type="radio" name="Options" id="inlineRadio3" value="3">
                        <label class="form-check-label" for="inlineRadio3">3</label>
                    </div>
                    <div class="form-check form-check-inline" id = 'ratings-radio'>
                        <input class="form-check-input" type="radio" name="Options" id="inlineRadio4" value="4">
                        <label class="form-check-label" for="inlineRadio4">4</label>
                    </div>
                    <div class="form-check form-check-inline" id = 'ratings-radio'>
                        <input class="form-check-input" type="radio" name="Options" id="inlineRadio5" value="5">
                        <label class="form-check-label" for="inlineRadio5">5</label>
                    </div>
                    <div class="form-check form-check-inline" id = 'ratings-radio'>
                        <input class="form-check-input" type="radio" name="Options" id="inlineRadio6" value="6">
                        <label class="form-check-label" for="inlineRadio6">6</label>
                    </div>
                    <div class="form-check form-check-inline" id = 'ratings-radio'>
                        <input class="form-check-input" type="radio" name="Options" id="inlineRadio7" value="7">
                        <label class="form-check-label" for="inlineRadio7">7</label>
                    </div>
                    <div class="form-check form-check-inline" id = 'ratings-radio'>
                        <input class="form-check-input" type="radio" name="Options" id="inlineRadio8" value="8">
                        <label class="form-check-label" for="inlineRadio8">8</label>
                    </div>
                    <div class="form-check form-check-inline" id = 'ratings-radio'>
                        <input class="form-check-input" type="radio" name="Options" id="inlineRadio9" value="9">
                        <label class="form-check-label" for="inlineRadio9">9</label>
                    </div>
                    <div class="form-check form-check-inline" id = 'ratings-radio'>
                        <input class="form-check-input" type="radio" name="Options" id="inlineRadio10" value="10">
                        <label class="form-check-label" for="inlineRadio10">10</label>
                    </div>
                </div>
                    <br>
                    <h3>Your thoughts?</h3>
                    <br>
                    <input type="text" id="rate-comments" placeholder="Leave a review....">
                    <button class="submit-button" id="add-review"> Submit</button>
            </form>

        </div>
        <div>
            <h5>Reviews</h5>
            @foreach($reviews as $review)
                <div>
                    <div>{{$review->username}}</div>
                    <div>{{$review->rating}}</div>
                    <div>{{$review->review_text}}</div>
                </div>
            @endforeach
        </div>
    </main>
</body>