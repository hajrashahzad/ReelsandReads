<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<title>Register</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="{{url('css/stylesheet.css')}}">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
		<script src="https://kit.fontawesome.com/7f473dda5c.js" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	</head>
	<body style="background-image: url('./images/The\ Blue\ Lagoon.jpg'); background-size: cover;">
	<div style="display:flex; align-items: center;justify-content: center;">
		<div class="register">
			<h1>Register</h1>
			<div class="links">
				<a href="login">Login</a>
				<a href="register" class="active">Register</a>
			</div>
			<form action="register" method="POST" autocomplete="off">
			@csrf
				<div id="responsecontainer">
						<div id="liveresponse">
							
						</div>
				</div>	
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				
				<label for="email">
					<i class="fas fa-envelope"></i>
				</label>
				<input type="email" name="email" placeholder="Email" id="email" required>			
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				
				<label for="confirmpassword">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="confirmpassword" placeholder="Confirm Password" id="confirmpassword" required>
				<div>
					<div class='msg'>{{$message}}</div>
				</div>
				<input type="submit" value="Register" name="submit">
			</form>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#username").on("keyup", function(e){
				if ($("#username").val() !== "")
				{
					$.ajax({
						type:'POST',
						url:'/livesearch',
						data:{
							name: $("#username").val(),
							_token: $('meta[name="csrf-token"]').attr('content')
						},
						success:function(response){
							$("#liveresponse").html(response.content);
						},
						error: function(error) {
							console.log(error);
						}
					});
				}
				else
				{
					$("#liveresponse").html("");
				}
			});

			$("#username").on("keydown", function(e){
				if ($("#username").val() === "")
				{
					$("#liveresponse").html("");
				}
			});


			$("#confirmpassword").on("keyup",function(){
				if($("#confirmpassword").val()=="" && $("#password").val()==""){
					$("#liveresponse").html("");
				}
				else if($("#confirmpassword").val()==$("#password").val()){
					$("#liveresponse").html("<p style='color:green;padding:0 5px;'>Passwords Match!</p>");
				}
				else{
					$("#liveresponse").html("<p style='color:red;padding:0 5px;'>Passwords don't match!</p>");
				}
			});
			$("#password").on("keyup",function(){
				if($("#confirmpassword").val()=="" && $("#password").val()==""){
					$("#liveresponse").html("");
				}
				else if($("#confirmpassword").val()==$("#password").val()){
					$("#liveresponse").html("<p style='color:green;padding:0 5px;'>Passwords Match!</p>");
				}
				else{
					$("#liveresponse").html("<p style='color:red;padding:0 5px;'>Passwords don't match!</p>");
				}
			});
		});
	</script>
	</body>
</html>