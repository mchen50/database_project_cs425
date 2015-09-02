<?php 

	session_start();
    include("logout.php");
    include("query.php");

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Bank Account</title>

    <!-- Bootstrap -->
    <link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="main.css" rel="stylesheet">
    
  </head>
  
<body data-spy="scroll" data-target=".navbar-collapse">
    <div class="navbar navbar-default navbar-fixed-top">
  
  	<div class="container">
  	
  		<div class="navbar-header pull-left">
  		
  			
  			
  			<a class="navbar-brand">IIT CS425 Final Project</a>
            <p class="navbar-text">Hi, <?php include("myLogin.php"); echo getUsernameFromId($_GET['id']);?>! You are at BuyBest!.</p>
            <img src="BuyBest/buybest_icon.png" alt="The official BuyBest Icon">
  		</div>
  		
  		<div class="navbar-right navbar-nav nav">
            <div class="dropdown">
                <button type="button" class="btn btn-default dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">
                    <span class="glyphicon glyphicon-align-justify"></span>
                </button>
            
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Account Info</a></li>
                    <li><a href="home.php">Switch Group</a></li>
                    <li><a href="#">Messages</a></li>
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
             
             <h3 >Transfer to E-Account</h3>
             
                <?php
                   if(isset($_POST["transfer_submit"])){
                         $transfer_error=transferEAcc($transfer_error);
                         if($transfer_error){
                             echo '<div class="alert alert-danger">'.addslashes($transfer_error).'</div>';
                         }
                         else{
                            $parameter = $_SESSION["id"];
                            header("Location:home.php?id=$parameter");}
                   }
                     
                ?>
    
             <div class="add-yellp-form">
                 <form class="form-horizontal" method="post">
                  <div class="form-group">
                        <label for="fromBank" class="col-sm-2 control-label">Bank Balance</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="fromBank" placeholder="Enter amount from bank">
                        </div>
                  </div>
                    
                  <div class="form-group">
                        <label for="fromCard" class="col-sm-2 control-label">Card Balance</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="fromCard" placeholder="Enter amount from Card">
                        </div>
                  </div>
                 
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" name="transfer_sumbit" class="btn btn-primary">Transfer</button>
                        <a role="button" href="home.php?id=<?= $_SESSION['id']?>" class="btn btn-default">Cancel</a>
                    </div>
                  </div>
                </form>
             </div>
             
                  
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