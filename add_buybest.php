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
            <p class="navbar-text">Hi, <?php include("myLogin.php"); echo getUsernameFromId($_GET['id']);?>! You are at BuyBest!.</p>
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
         <div class="add-yellp-container">
             
             <h3 >Add a Laptop</h3>
             
             <div class="add-yellp-form">
                 <form class="form-horizontal" method="post">
                  <div class="form-group">
                        <label for="addYellpName" class="col-sm-2 control-label">Brand</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="addYellpName" placeholder="Enter Laptop Brand">
                        </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="addYellpStreet" class="col-sm-2 control-label">Model</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="addYellpStreet" placeholder="Enter Model Number">
                    </div>
                  </div>
                  
                  
                  <div class="form-group">
                    <label for="addYellpImg" class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-10">
                        <input type="file" name="addYellpImg">
                        <p class="help-block">Upload a nice photo of the laptop.</p>
                      </div>
                    
                  </div>
                 
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary">Add</button>
                        <?php echo '<a role="button" href=BuyBest_home.php?id='.$_GET['id'].' class="btn btn-default">Cancel</a>';?>
                    </div>
                  </div>
                </form>
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
