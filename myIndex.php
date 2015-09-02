<?php
	include("myLogin.php");
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UZ-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>IIT CS425 Final Project</title>
		<!-- Bootstrap -->
		<link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="main.css" rel="stylesheet">
	</head>
	<body data-spy="scroll" data-target=".navbar-collapse">
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand">IIT CS425 Final Project</a>
				</div>
				<div class="collapse navbar-collapse">
					<form id="login" class="navbar-form navbar-right" method="post">
						<div class="form-group">
							<input type="username" name="login_username" placeholder="Username" class="form-control"/>
						</div>
						<div class="form-group">
							<input type="password" name="login_password" placeholder="Password" class="form-control"/>
						</div>
						<input type="submit" name="login_submit" class="btn btn-success" value="Log In">
					</form>
				</div>
			</div>
		</div>
		<div class="topContainer">
			<div class="container contentContainer">
				<div class="row">
					<div class="col-md-6 col-md-offset-3" id="topRow">
						<?php
							include("logout.php");
							if(isset($_POST["login_submit"])){
								if(!Login()){
									$message = false;
									echo '<div class="alert alert-danger">'.addslashes($_SESSION["error"]).'</div>';}
								else{
									include("secure.php");
									$parameter = $_SESSION["id"];
									header("Location:home.php?id=$parameter");}}
							if(isset($_POST["signup_submit"])){
								$message = false;
				                                $signup_error=signUp($signup_error);
                                				if($signup_error){
				                                    	echo '<div class="alert alert-danger">'.addslashes($signup_error).'</div>';
				                                }
				                                else{
									include("secure.php");
									$parameter = $_SESSION["id"];
									header("Location:home.php?id=$parameter");}
                            				}

							if($message){
								echo '<div class="alert alert-success">'.addslashes($message).'</div>';	
							}
						?>
						<h1 class="marginTop">A Combination of Yellp and BuyBest</h1>
						<p class="lead">Submit reviews on restaurants and join a marketplace for laptops.</p>
						<p class="bold marginTop">Interested? Sign Up Below!</p>
						<form class="marginTop" method="post">
							<div class="form-group">
								<label for="username">Username</label>
								<input type="username" name="signup_username" class="form-control" placeholder="Your Username"/>
							</div>
							<div class="form-group">
								<label for="email">Email Address</label>
								<input type="email" name="signup_email" class="form-control" placeholder="Your Email"/>
							</div>
				                        <div class="form-group">
  								<label for="password">Password</label>
		  				                <input type="password" name="signup_password" class="form-control" placeholder="Password"/>								
							</div>
							<div class="form-group">
								<input type="submit" name="signup_submit" value="Sign Up" class="btn btn-success btn-lg marginTop"/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<!-- Compiled plugins -->
		<script src="Bootstrap/js/bootstrap.min.js"></script>
		<script>$(".contentContainer").css("min-height",$(window).height());</script>
	</body>
</html>
