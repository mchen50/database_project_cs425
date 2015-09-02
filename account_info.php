<?php 
	include("logout.php");
    include("query_ming.php");
?>
<!DOCTYPE html>
<html lang="en">
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
					<p class="navbar-text">Hi, <?php include("myLogin.php"); echo getUsernameFromId($_GET['id']);?>! Check out you Account info!</p>
					<img src="Yellp/yellp-icon.png" alt="The official Yellp Icon">
				</div>
				<div class="navbar-right navbar-nav nav">
					<div class="dropdown">
						<button type="button" class="btn btn-default dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">
							<span class="glyphicon glyphicon-align-justify"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<?php echo '<li><a href="account_info.php?id='.$_GET['id'].'">Account Info</a></li>'?>
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
				<h3>Your E-account Info</h3>
                <?php 
                        $eacc_id = getEaccID($_GET['id']);
                        $eacc_info = getEaccInfo($eacc_id);
                        echo '<p>Balance:  '.$eacc_info[1].'</p>
                <p>Credit Points:  '.$eacc_info[0].'</p>'
                ?>
                <br/>
                <h3>Your Bank Account Info</h3>
                <?php
                        if(checkBankAccount($_GET['id'])){
                            $b_account_id = getBankAccountID($_GET['id']);
                            $b_acc_info = getBankAccountInfo($b_account_id);
                            $bank_info = getBankInfo($b_account_id);
                            echo '<p>Bank Title:'.$bank_info[0].'</p>
                                <p>Bank Routing Number:'.$bank_info[1].'</p>
                                <p>Bank Account Balance: '.$b_acc_info[0].'</p>';
                        }
                        else{
                        echo '<p>You don\'t have a bank account yet. Add a your bank below</p>
                             <a role="button" href="addBAccount.php?id='.$_GET['id'].'" class="btn btn-primary">Add Bank</a>';
                        }
                ?>
                    
                
                <br/>
                <h3>Your Card Info</h3>
                <?php
                        if(checkAnyCard($_GET['id'])){
                            $cards=fetchCards($_GET['id']);
                            $num_cards=$cards->num_rows;
                            echo 'You have '.$num_cards.' cards<br/>';
                            echo '<ul>';
                                while($card=$cards->fetch_row()){
                                    echo 
                                    '<p>Card Company:'.$card[0].'</p>
                                    <p>Card Number:'.$card[1].'</p>
                                    <p>Card Balance:'.$card[2].'</p>'
                                    ;
                                }
                            echo '</ul>';
                            echo '<p>Add more cards</p>
                             <a role="button" href="addCAccount.php?id='.$_GET['id'].'" class="btn btn-primary">Add Card</a>';
                        }
                        else{
                        echo '<p>You don\'t have a card yet. Add a your card below</p>
                             <a role="button" href="addCAccount.php?id='.$_GET['id'].'" class="btn btn-primary">Add Card</a>';
                        }
                ?>
                
                <h3>Transfer money to your E-Account</h3>
                 <?php
                    if(isset($_POST["transfer_bank_submit"])){
                        $user_id = $_GET['id'];
                        $amount=$_POST["fromBank"];
                        if(enoughB2E($user_id, $amount)){
                            if(transferBank($user_id,-$amount)){
                                echo 'transfer from Bank Account successful <br/>';
                                if(insertBankTransfer($user_id, $amount)){
                                    if(updateEaccBal($user_id, $amount)){
                                        echo 'E-account balance is updated!<br/>';
                                    }
                                    else{
                                        echo 'E-account balance is not updated<br/>';
                                    }
                                    echo 'insert into transfer record successful<br/>';
                                }
                                else{
                                echo 'insert into transfer record fail<br/>';
                                }
                            }
                            else{
                            echo 'transfer from Bank Account fail<br/>';
                            }
                        }
                        else{
                        echo 'Not enough Bank Account balance to transfer<br/>';
                        }
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
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" name="transfer_bank_submit" class="btn btn-primary">Transfer</button>
                    </div>
                  </div>
                </form>
             </div>
                
                <div class="add-yellp-form">
                  <div class="form-group">
                        <label for="fromCard" class="col-sm-2 control-label">Card Balance</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="fromCard" placeholder="Enter amount from Card">
                        </div>
                  </div>
                 
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" name="transfer_bank_submit" class="btn btn-primary">Transfer</button>
                    </div>
                  </div>
                </form>
             </div>
            <div/>
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