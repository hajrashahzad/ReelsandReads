<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="{{url('css/stylesheet.css')}}">
		<script src="https://kit.fontawesome.com/7f473dda5c.js" crossorigin="anonymous"></script>	
	</head>
	<body style="background-image: url('./images/The\ Blue\ Lagoon.jpg'); background-size: cover;">
		<div style="display:flex; align-items: center;justify-content: center;">
			<div class="login">
				<h1>Login</h1>
				<div class="links">
					<a href="login" class="active">Login</a>
					<a href="register">Register</a>
				</div>
				<form action="login" method="POST">
                    @csrf
					<div id="responsecontainer">
						<div id="liveresponse">
							
						</div>
					</div>
					<label for="username">
						<i class="fas fa-user"></i>
					</label>
					<input type="text" name="username" placeholder="Username" id="username" required>
					<label for="password">
						<i class="fas fa-lock"></i>
					</label>
					<input type="password" name="password" placeholder="Password" id="password" required>
					<div>
						<div class='msg'>{{$message}}</div>
					</div>
					<input type="submit" value="Login" name="submit">
				</form>
			</div>
		</div>
		
	</body>
</html>