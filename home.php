<?php
    include("query.php");
    include("logout.php");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Groups</title>
		<!-- Bootstrap -->
		<link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="main.css" rel="stylesheet">
	</head>
	<body data-spy="scroll" data-target=".navbar-collapse">
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header pull-left">
					<?php echo '<a class="navbar-brand" href="home.php?id='.$_GET['id'].'">Groups</a>';?>
					<p class="navbar-text">Hi, <?php include("myLogin.php"); echo getUsernameFromId($_GET['id']);?>! Check out these interest groups.</p>
				</div>
				<div class="navbar-right navbar-nav nav">
					<div class="dropdown">
						<button type="button" class="btn btn-default dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">
							<span class="glyphicon glyphicon-align-justify"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="">Account Info</a></li>
							<li><a href="">Messages</a></li>
							<li class="divider"></li>
							<li><a href="myIndex.php?logout=1">Log Out</a></li>
						</ul>
					</div>
				</div>
			</div>	
		</div>
		<div class="topContainer">
			<div class = "container contentContainer">
				<div class="row">
                                	<?php
                                        	$this_result = getGroups();
                                         	while($r = mysqli_fetch_row($this_result)){
                                                	 echo	'<div class="col-sm-6 col-xs-6 col-md-6" id="topRow">
                                                 			<div class = "thumbnail group_choose_thumbnail">
                                                         			<img src="';echo $r[1];echo '/';echo $r[1];echo '_group.jpg" alt="image for Yellp"/>
                                                         			<div class="caption">
											<h3>';echo $r[1];echo '!</h3>
                                                                 			<p>...</p>
                                                                 			<a href="';echo $r[1];echo '_home.php?id='.$_GET['id'].'" class="btn btn-primary" role="button">Check It Out</a>
                                                         			</div>
                                                 			</div>
                                         			</div>';
	                                         }
                                 	?>
				</div>
                        <?php
							if(isset($_POST["buy_submit"])){
                                $parameter=$_SESSION["id"];
								if(!canAffort($_POST["price"])){
                                    
                                    if(checkBankAccount()||checkCard()){
                                        header("Location:transfer.php?id=$parameter");
                                    }
                                    else{
                                         header("Location:addBCAccount.php?id=$parameter");
                                    }  
                                }
								else{
									header("Location:buy.php?id=$parameter");
                                }
                            }
						?>
                
                        <form method="post">
							
                            <div class="form-group">
  				                <input type="price" name="price" class="form-control" placeholder="price"/>								
				            </div>
                            <div class="form-group">
								<input type="submit" name="buy_submit" value="Buy" class="btn btn-success btn-lg marginTop"/>
							</div>
                           
						</form>
							
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
