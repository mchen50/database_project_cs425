<?php 

session_start();
include("logout.php");
include("query_ming.php");

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
                            <?php echo '<li><a href="account_info.php?id='.$_GET['id'].'">Account Info</a></li>'?>
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


                    <h3 >Add a card account</h3>
                    <?php
                        if(isset($_POST["addCard_submit"])){
                        $user_id = $_GET['id'];
                        if(checkCard($user_id,$_POST["addCardCom"],$_POST["addCardNum"])){
                            echo 'Card already in Database';
                        }
                        else{
                            if(insertCard($user_id,$_POST["addCardCom"],$_POST["addCardNum"],$_POST["addCardBill"],$_POST["addCardExp"],$_POST["addCardBalance"])){
                                header("Location:home.php?id=$user_id");
                            }
                            else{
                                echo 'create Card fail<br/>';
                            }
                        }

                    }
                    ?>
                    <div class="add-yellp-form">
                        <form class="form-horizontal" method="post">
                            <div class="form-group">
                                <label for="addCardCom" class="col-sm-2 control-label">Card Company</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="addCardCom" placeholder="Enter Card Company">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="addCardNum" class="col-sm-2 control-label">Card Number</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="addCardNum" placeholder="Enter Card Number">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="addCardBill" class="col-sm-2 control-label">Billing Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="addCardBill" placeholder="Enter Billing Address">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="addCardExp" class="col-sm-2 control-label">Expired data</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="addCardExp" placeholder="Enter Expired data">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="addCardBalance" class="col-sm-2 control-label">Card Balance</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="addCardBalance" placeholder="Enter Card Balance">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="addCard_submit" class="btn btn-primary">Add Card</button>
                                    <a role="button" href="home.php?id=<?= $_GET['id']?>" class="btn btn-default">Cancel</a>
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