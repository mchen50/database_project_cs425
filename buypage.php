<?php
session_start();
include("query_ming.php");
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
                    <a class="navbar-brand">TDP</a>
                    <p class="navbar-text">Hi, <?php include("myLogin.php"); echo getUsernameFromId($_GET['id']);?>! Check out these interest groups.</p>
                </div>
                <div class="navbar-right navbar-nav nav">
                    <div class="dropdown">
                        <button type="button" class="btn btn-default dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">
                            <span class="glyphicon glyphicon-align-justify"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php echo '<li><a href="account_info.php?id='.$_GET['id'].'">Account Info</a></li>'?>
                            <li><a href="home.php">Switch Group</a></li>
                            <li><a href="#">Messages</a></li>
                            <li class="divider"></li>
                            <li><a href="myIndex.php?logout=1">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>	
        </div>
        <div class="topContainer">
            <div class = "container contentContainer">
                
                <?php
                        if(isset($_POST["buy_submit"])){
                            $user_id=$_GET['id'];
                            $seller_id = 29;
                            $laptop_id = 19;
                            $price=$_POST["price"];
                            if(canAffort($price,$user_id)){
                                updateEaccBal($user_id,-$price);
                                updateEaccBal($seller_id,-$price);
                                $ecc_id = getEaccID($user_id);
                                insertTransaction($laptop_id, $price,$seller_id,$user_id);
                                 if(insertTransaction($laptop_id, $price,$seller_id,$user_id)){
                                    echo 'New transaction is inserted! Buy Successful<br/>';
                                }
                                else{
                                 echo 'New transaction is not inserted<br/>';
                                }
                            }
                            else{
                                echo 'You cannot affort the laptop!<br/>';
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
