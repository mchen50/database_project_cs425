<?php 
	include("logout.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Secret Diary</title>
		<!-- Bootstrap -->
		<link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="main.css" rel="stylesheet">
	</head>
	<body data-spy="scroll" data-target=".navbar-collapse">
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header pull-left">
					<?php echo '<a class="navbar-brand" href="Yellp_home.php?id='.$_GET['id'].'">Yellp</a>';?>
					<p class="navbar-text">Hi, <?php include("myLogin.php"); echo getUsernameFromId($_GET['id']);?>!</p>
					<img src="Yellp/yellp-icon.png" alt="The official Yellp Icon">
				</div>
				<div class="navbar-right navbar-nav nav">
					<div class="dropdown">
						<button type="button" class="btn btn-default dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">
							<span class="glyphicon glyphicon-align-justify"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="">Account Info</a></li>
							<li><?php echo '<a href="home.php?id='.$_GET['id'].'">Switch Group</a>';?></li>
							<li><a href="">Messages</a></li>
							<li class="divider"></li>
							<li><a href="myIndex.php?logout=1">Log Out</a></li>
						</ul>
					</div>
				</div>
			</div>	
		</div>
		<div class="topContainer">
			<div class = "container contentContainer"  id = "super-container">
				<div class="add-yellp-container">
					<h3>Add a restaurant.</h3>
					<div class="add-yellp-form">
						<form class="form-horizontal" method="post">
							<div class="form-group">
								<label for="addYellpName" class="col-sm-2 control-label">Restaurant</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="addYellpName" placeholder="Enter Name">
								</div>
							</div>
							<div class="form-group">
								<label for="addYellpStreet" class="col-sm-2 control-label">Street</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="addYellpStreet" placeholder="Enter Street">
								</div>
							</div>
							<div class="form-group">
								<label for="addYellpCity" class="col-sm-2 control-label">City</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="addYellpCity" placeholder="Enter City">
								</div>
							</div>
							<div class="form-group">
								<label for="addYellpState" class="col-sm-2 control-label">State</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="addYellpState" placeholder="Enter State">
								</div>
							</div>
							<div class="form-group">
								<label for="addYellpImg" class="col-sm-2 control-label">Image</label>
								<div class="col-sm-10">
									<input type="file" name="addYellpImg">
										<p class="help-block">Upload a nice phote of the restaurant.</p>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button name="add_submit" type="submit" class="btn btn-primary">Add</button>
									<?php echo '<a role="button" href="Yellp_home.php?id='.$_GET['id'].'" class="btn btn-default">Cancel</a>';?>
								</div>
							</div>
						</form>
				                <?php
				                        include("queries.php");
							if(isset($_POST["add_submit"])){
								$n = $_POST["addYellpName"];
								$str = $_POST["addYellpStreet"];
								$c = $_POST["addYellpCity"];
								$sta = $_POST["addYellpState"];
								if(empty($n) || empty($str) || empty($c) || empty($sta))
									 echo '<div class="alert alert-danger">All fields are mandatory.</div>';
								else if(!$added = addRestaurant($n,$str,$c,$sta)){
									echo '<div class="alert alert-danger">That restaurant already exists.</div>';
								}
								else { 
									echo '<div class="alert alert-success">Restaurant was added successfully.</div>';
									$id = createActivity(1,'Added Restaurant');
									addActivity($_GET['id'],$id);

								}
							}
				                ?>
					</div>
				</div>
			</div>
		</div>
		<!-- jQuery  -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<!-- Compiled plugins  -->
		<script src="Bootstrap/js/bootstrap.min.js"></script>
		<script>
			$(".contentContainer").css("min-height",$(window).height());
		</script>
	</body>
</html>
