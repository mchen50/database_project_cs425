<?php
    function checkBankAccount(){
        include("connection.php");
		$query ="SELECT * FROM (b_account INNER JOIN has_b_account ON b_account.id = has_b_account.b_account_id) WHERE user_id ='".$_SESSION['id']."'";
		$result = $con->query($query);
        $row_num = $result->num_rows;
        $con->close();
		if(!$row_num){
			 return false;
		}
        else{
            return true;
        }
    }

    function checkCard(){
        include("connection.php");
		$query ="SELECT * FROM (card INNER JOIN has_card ON card.id = has_card.card_id) WHERE user_id ='".$_SESSION['id']."'";
		$result = $con->query($query);
        $row_num = $result->num_rows;
        $con->close();
		if(!$row_num){
			 return false;
		}
        else{
            return true;
        }
    }

    function canAffort($price){
        include("connection.php");
		$query = "SELECT balance FROM (e_account INNER JOIN has_e_account ON e_account.id = has_e_account.e_account_id) WHERE user_id ='".$_SESSION['id']."'";
		$result = $con->query($query);
        $row=$result->fetch_row;
        $balance = $row[0];
        $con->close();
		if($balance>=$price){
			 return true;
		}
        else{
            return false;
        }
    }

    $addBank_error=isset($addBank_error) ? $addBank_error : '';
    function addBank($addBank_error){
        $addBank_error=isset($addBank_error) ? $addBank_error : '';
        
        if(empty($_POST['addBankTitle'])){
            $addBank_error.="<br/>Please enter your Bank Title.";
        }
        
        if(empty($_POST['addBankRouting'])){
            $addBank_error.="<br/>Please enter your Bank Routing.";
        } 
        
        if(empty($_POST['addBankBalance'])){
            $addBank_error.="<br/>Please enter your Bank Balance.";
        }
        
        if ($addBank_error){
            $addBank_error= "There were error(s) in your Add Bank details:".$addBank_error;
            return $addBank_error;
        }
        else{
            $bankTitle = $_POST['addBankTitle'];
            $bankRouting = $_POST['addBankRouting'];
            $bankBalance = $_POST['addBankBalance'];
            
            $id=insertBAccount($balance); //need trigger
            insertBank($id,$bankTitle,$bankRouting);
            
        }
        $addBank_error='';
		return $addBank_error;
	}

    function insertBAccount($bal){
        include("connection.php");
        $query = "INSERT INTO `b_account` (`number`, balance) VALUES (1, '".$bal."')";
        $con->query($query);
        $id= $con->insert_id;
        
        $query = "INSERT INTO `has_b_account` (user_id, b_account_id) VALUES ('".$_SESSION['id']."', '".$id."')";
        $con->close();
        return $id;
    }

    function insertBank($b_acc_id,$bankT,$bankR){
        include("connection.php");
        $query = "INSERT INTO `bank` (name, rounting_number) VALUES ('".$bankT."', '".$bankR."')";
        $con->query($query);
        $bank_id= $con->insert_id;
        
        $query = "INSERT INTO `has_bank` (b_account_id, bank_id) VALUES ('".$b_acc_id."', '".$bank_id."')";
        $con->close();
        return true;
    }

    $addCard_error=isset($addCard_error) ? $addCard_error : '';
    function addCard($addCard_error){
        $addCard_error=isset($addCard_error) ? $addCard_error : '';
        
        if(empty($_POST['addCardCom'])){
            $addCard_error.="<br/>Please enter your Bank Title.";
        }
        
        if(empty($_POST['addCardNum'])){
            $addCard_error.="<br/>Please enter your Card Number.";
        } 
        
        if(empty($_POST['addCardBill'])){
            $addCard_error.="<br/>Please enter your Card Billing Address.";
        }
        
        if(empty($_POST['addCardExp'])){
            $addCard_error.="<br/>Please enter your Card Exipired date.";
        }
        
        if(empty($_POST['addCardBalance'])){
            $addCard_error.="<br/>Please enter your Card Balance.";
        }
        
        if ($addCard_error){
            $addCard_error= "There were error(s) in your Add Card details:".$addCard_error;
            return $addCard_error;
        }
        else{
            $cardCom = $_POST['addCardCom'];
            $cardNum = $_POST['addCardNum'];
            $cardBill= $_POST['addCardBill'];
            $cardExp = $_POST['addCardExp'];
            $cardBal= $_POST['addCardBalance'];

            insertCard($cardCom, $cardNum, $cardBil,$cardExp,$cardBal);
            $success="You've been signed up!";
            
        }
        $addCard_error='';
		return $addCard_error;
	}

    function insertCard($com, $num, $addr,$exp,$bal){
        include("connection.php");
        $query = "INSERT INTO `card` (`number`, `company`, `expiration_date`,billing_address,balance) VALUES ('".$num."', '".$com."', '".$exp."','".$addr."', '".$bal."')";
        $con->query($query);
        $id= $con->insert_id;
        
        $query = "INSERT INTO `has_card` (user_id, card_id) VALUES ('".$_SESSION['id']."', '".$id."')";
        $con->close();
        return true;
    }
    
    $transfer_error=isset($transfer_error) ? $transfer_error : '';
    function transferEAcc($transfer_error){
        $transfer_error=isset($transfer_error) ? $transfer_error : '';
        
        if(empty($_POST['fromBank']) && empty($_POST['fromCard'])){
            $transfer_error.="<br/>Please enter some amount.";
        }
        
        if ($transfer_error){
            $transfer_error= "There were error(s) in your Add Bank details:".$transfer_error;
            return $transfer_error;
        }
        else{
            $amount = $_POST['fromBank']+$_POST['fromCard'];
            
            updateEAcc($amount);
            insertTransfer($amount); //need card or bank
        }
        $transfer_error='';
		return $transfer_error;
    }

    function updateEAcc($amount){
        include("connection.php");
        $query = "SELECT id, balance FROM (e_account INNER JOIN has_e_account ON e_account.id = has_e_account.e_account_id) WHERE user_id ='".$_SESSION['id']."'";
		$result = $con->query($query);
        $row=$result->fetch_row;
        $eAcc_id = $row[0];
        $balance = $row[1];
        
        $newBalance = $balance +$amount;
        
        $query = "UPDATE e_account SET balance='".$newBalance."' WHERE id='".$eAcc_id ."'";
        $con->query($query);
        
        $query = "INSERT INTO `has_e_account` (user_id, e_account_id) VALUES ('".$_SESSION['id']."', '".$eAcc_id."')";
        $con->close();
        return true;
    }

    function insertTransfer($amount){
        
    }
?>