<?php 

session_start();

include("logout.php");

include("connection.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>TDP</title>

<!-- Bootstrap -->
<link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="main.css" rel="stylesheet">

</head>

<body data-spy="scroll" data-target=".navbar-collapse">
<div class="navbar navbar-default navbar-fixed-top">

<div class="container">

<div class="navbar-header pull-left">



<a class="navbar-brand">BuyBest</a>
<p class="navbar-text">Hi, <?php include("myLogin.php"); echo getUsernameFromId($_GET['id']);?>! You are at BuyBest!</p>
<img src="BuyBest/buybest_icon.png" alt="The official BuyBest Icon">
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
<li><a href="index.php?logout=1">Log Out</a></li>
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
<label for="buybest-search" id="search-label">Brand</label>
<input list="brands" name="brand">
<datalist id="brands">
<option value="Dell">
<option value="Asus">
<option value="Apple">
<option value="Lenovo">
<option value="Alienware">
</datalist>
<label for="buybest-search" id="search-label">Model</label>
<input list="models" name="model">
<datalist id="models">
<option value="1">
<option value="2">
<option value="3">
<option value="4">
<option value="5">
<option value="6">
<option value="7">
<option value="8">
<option value="9">
<option value="10">
</datalist>
<button type="submit" name="submit-search-name" value="restaurant-name" class="btn btn-danger">Search</button>
</form>
</div>

<div class="col-md-3 col-sm-3 col-xs-3 center" id = "add-object-div">
<p>Add a laptop model:</p>
<?php echo '<a role="button" href="add_buybest.php?id='.$_GET['id'].'" class="btn btn-warning"><span class="glyphicon glyphicon-plus"></span></a>';?>

</div>

</div>

<div class = "layout-block list-container-buybest">
<ul>

<!--
<li>
<div class="laptop-result">
<div class="col-md-3  col-sm-3 col-xs-3 center">
<div class="laptop-list-img">

<img src="BuyBest/laptop_1.jpg" alt="Some Laptops"/>

<div class="model-list-box">
<p>Brand:</p>
<p class="list-brand">Alienware</p>

<p>Model No.:</p>

<p class="list-model">17</p>
</div>
</div> 

<div class = "enter-laptop-box">
<div class="col-md-9">
<p>Smash to view related comments:</p> 
</div>

<div class="col-md-3">
<a role="button" href="#" class="btn btn-danger"><span class="glyphicon glyphicon-eye-open"></span></a>
</div>

</div>

</div>

<div class="col-md-7 col-sm-7 col-xs-7">
<div class="comment-list-user">
<div class="col-md-3 center">
<p class="list-user-name">User1</p>
</div>

<div class="col-md-3 center">
<p class="list-rank-text">Rank: <span class="list-rank">Geek</span></p>
</div>
</div>

<div class="comment-list-content">
<p>Best laptop I have ever seen!</p>
<p>Really want to buy one. Could anyone give me some money?</p>
</div>

</div>

<div class="col-md-2 col-sm-2 col-xs-2 center">
<div class="comment-side-box">
<h4>Type: Help</h4>
<a role="button" href="#" class="btn btn-primary">Help</a>

<div class="thumbs-box-laptop">

<p id="askThumbText">Thumb this comment:</p> 

<div class="thumbs-img-box">
<div class="thumb-up-box col-md-6">
<a role="button" href="#" class="btn btn-default"><span class="glyphicon glyphicon-thumbs-up"></span></a>
<p>2032</p>
</div>

<div class="thumb-down-box col-md-6">
<a role="button" href="#" class="btn btn-default"><span class="glyphicon glyphicon-thumbs-down"></span></a>
<p>20</p>
</div>
</div>   
</div>
</div>
</div>
</div>
</li>

-->								
<?php
$this_result = getComps();
while($r = mysqli_fetch_row($this_result)){
	$commentSearch = getCom($r[0]);
	echo	'<div class="col-sm-4 col-xs-4 col-md-4" id="topRow">
		<div class = "thumbnail group_choose_thumbnail">
		<img src="BuyBest/BuyBest_laptop_1.jpg" alt="Computer Image"/>
		<div class="caption">
		<h3>';echo $commentSearch;echo '</h3>
		<p>Brand: ';echo $r[2];echo '</p>
		<p>Model Number: ';echo $r[3];echo '</p>
		<p>User and Rank: </p>
		<p>Laptop Rating: ';echo $r[4];echo '</p>
		<p>Post Type: ';echo $r[1];echo '</p>

		<a href="home.php?id='.$_GET['id'].' class="btn btn-primary" role="button">View</a>
                                                         			</div>
                                                 			</div>
                                         			</div>';
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
 
<?php 
function getComID($lapID){
		include("connection.php");
		$query = "SELECT comment_id FROM has_comment WHERE (laptop_id = lapID)";
		$result = mysqli_query($con,$query);
		if(!$result){
			$_SESSION['message'] = "There are no comments available.";
			$con->close();
			return $_SESSION['message'];
		}
		$con->close();
		return getCom($result);
	} 
	
function getCom($comID){
		include("connection.php");
		$query = "SELECT content FROM comment WHERE (id = comID)";
		$result = mysqli_query($con,$query);
		if(!$result){
			$_SESSION['message'] = "There are no comments available.";
			$con->close();
			return $_SESSION['message'];
		}
		$con->close();
		return $result;
	}   
?>
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
