<?php
function checkBankAccount($user_id){
    include("connection.php");
    $query ="SELECT * FROM (b_account INNER JOIN has_b_account ON b_account.id = has_b_account.b_account_id) WHERE user_id =".$user_id."";
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

function canAffort($price,$user_id){
    include("connection.php");
    $query = "SELECT balance FROM (e_account INNER JOIN has_e_account ON e_account.id = has_e_account.e_account_id) WHERE user_id =".$user_id."";
    $result = $con->query($query);
    $row=$result->fetch_row();
    $balance = $row[0];
    $con->close();
    if($balance>=$price){
        return true;
    }
    else{
        return false;
    }
}

function insertBAccount($bal,$user_id){
    include("connection.php");
    $query = "INSERT INTO `b_account` (number, balance) VALUES (1, ".$bal.")";
    $con->query($query);
    $id= $con->insert_id;

    $query = "INSERT INTO `has_b_account` (user_id, b_account_id) VALUES (".$user_id.", ".$id.")";
    $con->query($query);
    $con->close();
    return $id;
}

function checkBank($bankT,$bankR){
    include("connection.php");
    $query= "SELECT id FROM bank WHERE name = '".$bankT."' AND routing_number = ".$bankR."";
    $result = $con->query($query);
    $row_num = $result->num_rows;
    if($row_num){
        $row = $result->fetch_row();
        $exist_bank_id = $row[0];
        $con->close();
        return $exist_bank_id;
    }
    else{
        $con->close();
        return false;
    }

}

function insertBank($bankT,$bankR){
    include("connection.php");

    $query = "INSERT INTO `bank` (name, routing_number) VALUES ('".$bankT."', ".$bankR.")";
    $con->query($query);
    $bank_id= $con->insert_id;
    if($bank_id){
        $con->close();
        return $bank_id;
    }
    else{
        $con->close();
        return false;
    }
}

function insert_HasBank($b_acc_id,$bank_id){
    include("connection.php");

    $query = "INSERT INTO `has_bank` (b_account_id, bank_id) VALUES (".$b_acc_id.", ".$bank_id.")";
    $con->query($query);
    $con->close();
    return true;
}

/*$addCard_error=isset($addCard_error) ? $addCard_error : '';
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
	}*/

function insertCard($user_id,$com, $num, $addr,$exp,$bal){
    include("connection.php");
    $query = "INSERT INTO `card` (`number`, `company`, `expiration_date`,billing_address,balance) VALUES ('".$num."', '".$com."', '".$exp."','".$addr."', ".$bal.")";
    $con->query($query);
    $card_id= $con->insert_id;

    if($card_id){
        $query = "INSERT INTO `has_card` (user_id, card_id) VALUES (".$user_id.", ".$card_id.")";
        $con->query($query);
        $con->close();
        return true;
    }
    else{
        return false;   
    }
}

function checkCard($user_id, $card_com, $card_num){
    include("connection.php");
    $query ="SELECT * FROM (card INNER JOIN has_card ON card.id = has_card.card_id) WHERE user_id =".$user_id." AND company = '".$card_com."' AND number='".$card_num."'";
    $result = $con->query($query);
    $row_num = $result->num_rows;
    if(!$row_num){
        $con->close();
        return false;
    }
    else{
        $con->close();
        return true;
    }
}

function enoughB2E($user_id,$trans_amount){
    include("connection.php");
    $query = "SELECT balance FROM (b_account INNER JOIN has_b_account ON b_account.id = has_b_account.b_account_id) WHERE user_id =".$user_id."";
    $result = $con->query($query);
    $row=$result->fetch_row();
    $balance = $row[0];
    $con->close();
    if($balance>=$trans_amount){
        return true;
    }
    else{
        return false;
    }
}

function fetchCards($user_id){
    include("connection.php");
    $query = "SELECT * FROM (card INNER JOIN has_card ON card.id = has_card.card_id) WHERE user_id =".$user_id."";
    $result = $con->query($query);
    $row_num=$result->num_rows;
    
    return $row_num;
}

function enoughC2E($card_id,$trans_amount){
    include("connection.php");
    $query = "SELECT balance FROM card WHERE id =".$card_id."";
    $result = $con->query($query);
    $row=$result->fetch_row();
    $balance = $row[0];
    $con->close();
    if($balance>=$trans_amount){
        return true;
    }
    else{
        return false;
    }
}


/*$transfer_error=isset($transfer_error) ? $transfer_error : '';
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
    $query = "SELECT id, balance FROM (e_account INNER JOIN has_e_account ON e_account.id = has_e_account.e_account_id) WHERE user_id ='".$_SESSION["id"]."'";
    $result = $con->query($query);
    $row=$result->fetch_row;
    $eAcc_id = $row[0];
    $balance = $row[1];

    $newBalance = $balance +$amount;

    $query = "UPDATE e_account SET balance='".$newBalance."' WHERE id='".$eAcc_id ."'";
    $con->query($query);

    $query = "INSERT INTO `has_e_account` (user_id, e_account_id) VALUES ('".$_SESSION["id"]."', '".$eAcc_id."')";
    $con->query($query);
    $con->close();
    return true;
}*/

function transferBank($user_id,$amount){
    include("connection.php");
    $query = "SELECT balance,id FROM b_account WHERE b_account.id = (SELECT b_account_id FROM has_b_account WHERE user_id=".$user_id.")";
    $result = $con->query($query);
    $row=$result->fetch_row();
    $balance = $row[0]+$amount;
    $b_account_id = $row[1];
    
    $query= "UPDATE b_account SET balance= ".$balance." WHERE id=".$b_account_id."";
    $con->query($query);
    $con->close();
    return true;
}

function transferCard($card_id,$amount){
    include("connection.php");
    $query = "SELECT balance FROM card WHERE id=".$card_id."";
    $result = $con->query($query);
    
    $row=$result->fetch_row();
    $balance = $row[0]+$amount;
    
    $query= "UPDATE card SET balance= ".$balance." WHERE id=".$card_id."";
    $con->query($query);
    $con->close();
    return true;
}

function insertBankTransfer($user_id,$amount){
    include("connection.php");
    $query = "SELECT b_account_id FROM has_b_account WHERE user_id=".$user_id."";
    $result = $con->query($query);
    $row=$result->fetch_row();
    $b_account_id = $row[0];
    
    $query = "INSERT INTO transfer (amount) VALUES (".$amount.");";
    $con->query($query);
    $transfer_id=$con->insert_id;
    
    if($transfer_id){
        $query = "INSERT INTO has_b_transfer (bank_account_id, transfer_id) VALUES (".$b_account_id.", ".$transfer_id.")";
        $con->query($query);
        $con->close();
        return true;
    }
    else{
        $con->close();
        return false;   
    }
}

function insertCardTransfer($card_id,$amount){
    include("connection.php");
    $query = "INSERT INTO transfer (amount) VALUES (".$amount.");";
    $con->query($query);
    $transfer_id=$con->insert_id;
    
    if($transfer_id){
        $query = "INSERT INTO has_c_transfer (card_id, transfer_id) VALUES (".$card_id.", ".$transfer_id.")";
        $con->query($query);
        $con->close();
        return true;
    }
    else{
        $con->close();
        return false;   
    }
}

function updateEaccBal($user_id, $amount){
    include("connection.php");
    $query = "SELECT balance,id FROM e_account WHERE e_account.id = (SELECT e_account_id FROM has_e_account WHERE user_id=".$user_id.")";
    $result = $con->query($query);
    $row=$result->fetch_row();
    $balance = $row[0]+$amount;
    $e_account_id = $row[1];
    
    $query= "UPDATE e_account SET balance= ".$balance." WHERE id=".$e_account_id."";
    $con->query($query);
    $con->close();
    return true;
}

function getEaccID($user_id){
    include("connection.php");
    $query = "SELECT e_account_id FROM has_e_account WHERE user_id=".$user_id."";
    $result = $con->query($query); 
    
    if($result->num_rows){
        $row=$result->fetch_row();
         $e_account_id = $row[0];
        $con->close();
        return $e_account_id;
    }
    else{
        $con->close();
        return false;
    }
    
}

function insertTransaction($laptop_id, $amount,$seller_id,$buyer_id){
    include("connection.php");
    $query = "INSERT INTO transaction (laptop_id,amount,seller_id,purchaser_id,date_time) VALUES (".$laptop_id.",".$amount.",".$seller_id.",".$buyer_id.",NOW());";
    $con->query($query);
    $transaction_id=$con->insert_id;
    
    if($transaction_id){
        $query = "INSERT INTO has_transaction (e_account_id, transaction_id) VALUES (".$seller_id.", ".$transaction_id.")";
        $con->query($query);
        $query = "INSERT INTO has_transaction (e_account_id, transaction_id) VALUES (".$buyer_id.", ".$transaction_id.")";
        $con->query($query);
        $con->close();
        return true;
    }
    else{
        $con->close();
        return false;   
    }
}
?>