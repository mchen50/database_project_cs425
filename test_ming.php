<?php

 include("query_test.php");

function test_canAffort(){
    if(canAffort(241,11)){
        echo 'You can affort the laptop!<br/>';
    }
    else{
     echo 'You cannot affort the laptop!<br/>';
    }
}

function test_checkBankAccount(){
    if(checkBankAccount(20)){
        echo 'check Bank account exist <br/>';
    }
    else{
     echo 'bank account not exist<br/>';
    }
}

function test_insertBAccount(){
    if($new_BAccountID=insertBAccount(9999,20)){
        echo 'create bank account pass<br/>';
        
    }
    else{
     echo "create bank account fail";
    }
}

function test_checkBank(){
    if($exist_bank_id=checkBank("Chase",31131)){
        echo 'bank exists<br/>';
    }
    else{
     echo "bank not exist";
    }
}

function test_insertBank(){
    if($newBankid=insertBank("Chase",41515)){
        echo 'create bank pass <br/>';
    }
    else{
     echo "create bank fail";
    }
}

function test_insertHasBank(){
    if(insert_hasBank(31,41)){
        echo 'insert has_bank pass <br/>';
    }
    else{
     echo "insert has_bank fail";
    }
}

function test_checkCard(){
    if(checkCard(8,'Discover','11141451')){
        echo 'check Card exist <br/>';
    }
    else{
     echo 'card not exist<br/>';
    }
}

function test_insertCard(){
    if(insertCard(8,'Discover','1141931141451','3201 S State Str','2015-04-09',9999)){
        echo 'create Card pass <br/>';
    }
    else{
     echo 'create Card fail<br/>';
    }
}

function test_enoughB2E(){
    if(enoughB2E(20,600)){
        echo 'Enough Bank Account balance to transfer<br/>';
    }
    else{
     echo 'Not enough Bank Account balance to transfer<br/>';
    }
}

function test_fetchCards(){
    $numOfCards=fetchCards(8);
    echo 'You have '.$numOfCards.' cards<br/>';
}
    
function test_enoughC2E(){
    if(enoughC2E(5,600)){
        echo 'Enough Card balance to transfer<br/>';
    }
    else{
     echo 'Not enough Card balance to transfer<br/>';
    }
}

function test_transferBank(){
    if(transferBank(6,-16)){
        echo 'transfer from Bank Account successful <br/>';
    }
    else{
     echo 'transfer from Bank Account fail<br/>';
    }
}


function test_transferCard(){
    if(transferCard(5,-20)){
        echo 'transfer from Card successful<br/>';
    }
    else{
     echo 'transfer to e-account fail<br/>';
    }
}

function test_insertBankTransfer(){
    if(insertBankTransfer(6,16)){
        echo 'insert into transfer record successful<br/>';
    }
    else{
     echo 'insert into transfer record fail<br/>';
    }
}

function test_insertCardTransfer(){
    if(insertCardTransfer(5,20)){
        echo 'insert into transfer record successful<br/>';
    }
    else{
     echo 'insert into transfer record fail<br/>';
    }
}

function test_updateEaccBal(){
    if(updateEaccBal(8,20)){
        echo 'E-account balance is updated!<br/>';
    }
    else{
     echo 'E-account balance is not updated<br/>';
    }
}

function test_getEaccID(){
    $ecc_id = getEaccID(8);
    if($ecc_id){
        echo 'Your e-account id is '.$ecc_id.'<br/>';
    }
    else{
        echo 'fail to get your e-account<br/>';
    }
}

function test_insertTransaction(){
    if(insertTransaction(1,20,8,9)){
        echo 'New transaction is inserted!<br/>';
    }
    else{
     echo 'New transaction is not inserted<br/>';
    }
}
?>