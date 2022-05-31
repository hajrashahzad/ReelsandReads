<!DOCTYPE html>

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

        $(document).ready(function() {
            $("#change-password").click(function(e) {
                if($("#change-password-form").css("display") !== 'none')
                {
                    $("#change-password-form").slideUp(200);
                }
                else
                {
                    $("#change-password-form").slideDown(200);
                }
            })

            $("#change-email").click(function(e) {
                if($("#change-email-form").css("display") !== 'none')
                {
                    $("#change-email-form").slideUp(200);
                }
                else
                {
                    $("#change-email-form").slideDown(200);
                }
            })

            $("#delete-account").click(function(e) {
                if($("#delete-account-form").css("display") !== 'none')
                {
                    $("#delete-account-form").slideUp(200);
                }
                else
                {
                    $("#delete-account-form").slideDown(200);
                }
            })

            $("#reset-password").click(function(e) {
                e.preventDefault();
                const existing = $("#existing-password").val();
                const newPass = $("#new-password").val();
                console.log(existing, newPass);
                let _token   = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "/reset-password",
                    method: "POST",
                    data: {
                        existing,
                        newPass,
                        _token
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.redirectURL !== "")
                            window.location.pathname = response.redirectURL;                        
                    },
                    error: function(error) {console.log(error)}
                })
                $("#existing-password").val("");
                $("#new-password").val("");
            })

            $("#reset-email").click(function(e) {
                e.preventDefault();
                const newEmail = $("#new-email").val();
                let _token   = $('meta[name="csrf-token"]').attr('content');
                console.log(newEmail);
                $.ajax({
                    url: "/reset-email",
                    method: "POST",
                    data: {
                        newEmail,
                        _token
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.redirectURL !== "")
                            window.location.pathname = response.redirectURL;                        
                    },
                    error: function(error) {console.log(error)}
                })
            })

            $("#auth-delete").click(function(e) {
                e.preventDefault();
                let _token   = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "/delete-account",
                    method: "POST",
                    data: {
                        _token
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.redirectURL !== "")
                            window.location.pathname = response.redirectURL;                        
                    },
                    error: function(error) {console.log(error)}
                })
            })

            $("#cancel-delete").click(function(e) {
                e.preventDefault();
                $("#delete-account-form").slideUp(200);
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
                <li><a href="settings">
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
    <main class = 'main-body'>
        <br><br><br><br><br><br><br>
        <div class='main-widget'>
            <div class="settings-container">
                <div class="settings-item">
                    <div id="change-password" class='option-header'>Update Password</div>
                    <div id="change-password-form" style="display: none" class="option-form-container">
                        <div class='option-form'>
                            <div class="option-input-container">
                                <div class='option-form-label'>Enter your current password:</div>
                                <input id='existing-password' class="option-form-text-input" type="password">
                            </div>
                            <div class="option-input-container">
                                <div class='option-form-label'>Enter your new password:</div>
                                <input id='new-password' class="option-form-text-input" type="password">
                            </div>
                            <button class="option-form-yes-button" id="reset-password">Update Password</button>
                        </div>
                    </div>
                </div>

                <div class="settings-item">
                    <div id="change-email" class='option-header'>Update Email</div>
                    <div id="change-email-form" style="display: none" class="option-form-container">
                        <div class='option-form'>
                            <div class="option-input-container">
                                <div class='option-form-label'>Enter your new email:</div>
                                <input id='new-email' class="option-form-text-input">
                            </div>
                            <button class="option-form-yes-button" id="reset-email">Update</button>
                        </div>
                    </div>
                </div>

                <div class="settings-item">
                    <a class='option-header' href="preferences">Update Preferences</a>
                </div>

                <div class="settings-item">
                    <div id="delete-account" class='option-header'>Delete Account</div>
                    <div id="delete-account-form" style="display: none" class="option-form-container">
                        <div class='option-form'>
                            <div class="option-form-auth-label">Are you sure you want to delete your account?</div>
                            <div class="option-form-auth-input">
                                <button class="option-form-yes-button" id="auth-delete" style="margin-right: 10px; width: 100px;">Yes</button>
                                <button class="option-form-yes-button" id="cancel-delete" style="width: 100px;">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>