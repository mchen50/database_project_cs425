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

                    <h3 >Add a bank account</h3>

                    <?php
                        if(isset($_POST["addBank_submit"])){
                        $user_id = $_GET['id'];
                        if(checkBankAccount($user_id)){
                            echo 'check Bank account exist <br/>';
                        }   
                        else{
                            if($new_BAccountID=insertBAccount($_POST["addBankBalance"],$user_id)){
                                if($exist_bank_id=checkBank($_POST["addBankTitle"],$_POST["addBankRouting"])){
                                    if(insert_hasBank($new_BAccountID,$exist_bank_id)){
                                        header("Location:home.php?id=$user_id");
                                    }
                                    else{
                                        echo "insert has_bank fail";
                                    }
                                }
                                else{
                                    if($newBankid=insertBank($_POST["addBankTitle"],$_POST["addBankRouting"])){
                                        if(insert_hasBank($new_BAccountID,$newBankid)){
                                            header("Location:home.php?id=$user_id");
                                        }
                                        else{
                                            echo "insert has_bank fail";
                                        }
                                    }
                                    else{
                                        echo "create bank fail";
                                    }
                                }
                            }
                            else{
                                echo "create bank fail";
                            }
                        }
                    }

                    ?>

                    <div class="add-yellp-form">
                        <form class="form-horizontal" method="post">
                            <div class="form-group">
                                <label for="addBankTitle" class="col-sm-2 control-label">Bank Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="addBankTitle" placeholder="Enter Bank Title">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="addBankRouting" class="col-sm-2 control-label">Routing Number</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="addBankRouting" placeholder="Enter Bank Rounting Number">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="addBankBalance" class="col-sm-2 control-label">Balance</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="addBankBalance" placeholder="Enter Bank Balance">
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="addBank_submit" class="btn btn-primary">Add Bank</button>
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