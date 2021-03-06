<!DOCTYPE html>
<html lang="en">
	<?php
		include("logout.php");
		include("myLogin.php");
		include("queries.php");
		addMember(1,$_GET['id']);
		echo $_GET['id'];
		if(!isMember(1,$_GET['id'])){
			$id = createActivity(1,'Joined Group');
			addActivity($_GET['id'],$id);
		}
	?>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Yellp</title>
		<!-- Bootstrap -->
		<link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="main.css" rel="stylesheet">
	</head>
	<body data-spy="scroll" data-target=".navbar-collapse">
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header pull-left">
					<?php echo '<a class="navbar-brand" href="Yellp_home.php?id='.$_GET['id'].'">Yellp</a>';?>
					<p class="navbar-text">Hi, <?php echo getUsernameFromId($_GET['id']);?>! You are at Yellp!</p>
					<img src="Yellp/yellp-icon.png" alt="The official Yellp Icon">
				</div>
				<div class="navbar-right navbar-nav nav">
					<div class="dropdown">
						<button type="button" class="btn btn-default dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">
							<span class="glyphicon glyphicon-align-justify"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="">Account Info</a></li>
							<li><?php echo '<a href=home.php?id='.$_GET['id'].">Switch Group</a>";?></li>
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
				<div class = "layout-block search-container-top">
					<div class="col-md-2 col-sm-2 col-xs-2 center">
						<h4 class = "filter-text">Filter:</h3>
					</div>
					<div class="col-md-7 col-sm-7 col-xs-7 center">
						<form class="form-inline" method = "post">
							<label for="yellp-search" id="search-label">Restaurants</label>
							<input type="text" name="restaurant-name" class="form-control" id="yellp-search" placeholder="Name">
							<button type="submit" name="submit-search-name" class="btn btn-primary">Search</button>
						</form>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-3 center" id = "add-object-div">
						<p>Add a restaurant:</p>
						<?php echo '<a role="button" href="add_yellp.php?id='.$_GET['id'].'" class="btn btn-warning"><span class="glyphicon glyphicon-plus"></span></a>';?>
					</div>
				</div>
				<div class = "layout-block list-container">
					<ul>
						<?php
							if(isset($_POST['submit-search-name']) && !empty($_POST['restaurant-name'])){
								$this_result = findRestaurant($_POST['restaurant-name']);
								if(!$this_result){
									echo '<div class="alert alert-danger">There are no restaurants with that name.</div>';
								}
								else {
									while($r = mysqli_fetch_row($this_result)){
                                                                                echo '<li><div class="search-result">
	                                                                                <div class="col-md-3  col-sm-3 col-xs-3 center">
        	                                                                                <div class="object-list-img thumbnail">
                	                                                                                <img src="Yellp/res-1.jpg" alt="Some Restaurants"/>
                                                                                                </div> 
                                                                                        </div>
                                                                                                <div class="col-md-6 col-sm-6 col-xs-6 center ">
                                                                                                        <div class="object-name-box">
                                                                                                                <h3 class="search-title">
                                                                                                                        <span><a class="biz-name" href="">';echo $r[4];echo'!</a></span>
                                                                                                                </h3>
                                                                                                                <div class = "rating-box">
                                                                                                                        <div class = "rating-img">
                                                                                                                                <img src="Yellp/rate_2.PNG" alt="Some Rating"/>
                                                                                                                        </div>
                                                                                                                        <p class ="rating-num"> 5 reviews</p>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                                <div class="col-md-3 col-sm-3 col-xs-3 center">
                                                                                                        <div class=" address-full-box">
                                                                                                                <div class="address-box">
                                                                                                                        <p>';echo $r[7];echo '</br> ';echo $r[2];echo ', ';echo $r[3];echo '</p>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div></li>';
								}	}
							}
							else {
                	                                        if(!$this_result = getRestaurants()){
									echo '<h3>'.$_SESSION['error'].'</h3>';
                                                	        }else{
									while($r = mysqli_fetch_row($this_result)){
                                                                                echo '<li><div class="search-result">
				                                                                <div class="col-md-3  col-sm-3 col-xs-3 center">
				                                                                        <div class="object-list-img thumbnail">
                                				                                                <img src="Yellp/res-1.jpg" alt="Some Restaurants"/>
                                                                				        </div> 
				                                                                </div>
                                				                                <div class="col-md-6 col-sm-6 col-xs-6 center ">
                                                                				        <div class="object-name-box">
				                                                                                <h3 class="search-title">
                                				                                                        <span><a class="biz-name" href="">';echo $r[4];echo'!</a></span>
                                                                				                </h3>
				                                                                                <div class = "rating-box">
                                				                                                        <div class = "rating-img">
                                                                				                                <img src="Yellp/rate_2.PNG" alt="Some Rating"/>
				                                                                                        </div>
                                				                                                        <p class ="rating-num"> 5 reviews</p>
                                                                				                </div>
				                                                                        </div>
                                				                                </div>
                                                	                			<div class="col-md-3 col-sm-3 col-xs-3 center">
			                                	                                        <div class=" address-full-box">
                        			                	                                        <div class="address-box">
                                                                               					        <p>';echo $r[7];echo '</br> ';echo $r[2];echo ', ';echo $r[3];echo '</p>
				                                                        	                </div>
                                				                                	</div>
				                                                                </div>
        	                			                                </div></li>';
                                                                        }
								}
                	                                }
						?>
					</ul>
				</div>
				<div class="pageupdown-bar center">          
					<ul class="pagination">
						<li class="disabled"><a href="" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
						<li class="active"><a href="">1 <span class="sr-only">(current)</span></a></li>
						<li><a href="">2 </a></li>
						<li><a href="">3 </a></li>
						<li><a href="">4 </a></li>
						<li><a href="" aria-label="Next">&raquo;</a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- jQuery  -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<!-- Compiled plugins  -->
		<script src="Bootstrap/js/bootstrap.min.js"></script>
		<script>
			$(".contentContainer").css("min-height",$(window).height());
			/*$("textarea").css("height",$(window).height()-110);
			  $("textarea").keyup(function() {
			  $.post("updatediary.php", {diary:$("textarea").val()} );
			  });*/
		</script>
	</body>
</html>
