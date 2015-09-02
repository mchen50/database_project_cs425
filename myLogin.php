<?php
	$_SESSION["error"] = "null";
    $signup_error=isset($signup_error) ? $signup_error : '';
    $success = "null";

	function Login(){
		if(empty($_POST['login_username']) && empty($_POST['login_password'])){
			$_SESSION["error"]="Please enter your username and password.";
			return false;}
		else if(empty($_POST['login_password'])){
			$_SESSION['error']="Please enter your password.";
			return false;}
		else if(empty($_POST['login_username'])){
			$_SESSION['error']="Please enter your username.";
			return false;}

		$username = trim($_POST['login_username']);
		$password = trim($_POST['login_password']);

		if(!$id=CheckCredentials($username,$password)){
			return false;}
		
		$_SESSION["id"] = $id;
		return true;
	}
	
	function CheckCredentials($u,$p){
		include("connection.php");
		$query = "SELECT * FROM user WHERE username='".$u."'";
		$result = mysqli_query($con,$query);
		$row = mysqli_fetch_row($result);
		if(!$row){
			$_SESSION['error'] = "The user was not found. Please register.";
			$con->close();
			 return false;
		}
		if(strcmp($p,$row[2])!=0){
			$_SESSION['error'] = "Your password is incorrect. Please try again.";
			$con->close();
			return false;
		}
		$con->close();
		return $row[0];
	}

	function getUsernameFromId($i){
		include("connection.php");
		$query = "SELECT username FROM user WHERE id='".$i."'";
		$result = mysqli_query($con,$query);
		$row = mysqli_fetch_row($result);
		if(!$row){
			$_SESSION['error'] = "Unknown user";
			$con->close();
			return $_SESSION['error'];
		}
		$con->close();
		return $row[0];
	}

	function signUp($signup_error){
        $signup_error=isset($signup_error) ? $signup_error : '';
        
        if(empty($_POST['signup_username'])){
            $signup_error.="<br/>Please enter your username.";
        }
        
        if(empty($_POST['signup_email'])){
            $signup_error.="<br/>Please enter your email.";
        } 
        else if (!filter_var($_POST['signup_email'], FILTER_VALIDATE_EMAIL)){
            $signup_error.="<br/>Please enter a valid email.";
        }
        
        if(empty($_POST['signup_password'])){
            $signup_error.="<br/>Please enter your password.";
        }
        else {
            if (strlen($_POST['signup_password'])<8){
                $signup_error.="<br/>Please enter at least 8 characters.";
            }
            if(!preg_match('/[A-Z]/', $_POST['signup_password'])){
                $signup_error.= "<br/>Please include min 1 capital letter.";
            }
        }
        
        if ($signup_error){
            $signup_error= "There were error(s) in your sign up details:".$signup_error;
            return $signup_error;
        }
        else{
            $username = $_POST['signup_username'];
            $email = $_POST['signup_email'];
            $password = $_POST['signup_password'];

            if (!checkSignupUser($username,$email)){
                $signup_error= "That username is already registered. Please log in.";
                return $signup_error;
            }
            else {
                $id=insertUser($username,$email,$password);
                insertEAcc($id);
                $success="You've been signed up!";
            }
        }
        $signup_error='';
		$_SESSION["id"] = $id;
		return $signup_error;
	}
	
    function checkSignupUser($u,$e){
        include("connection.php");

        $query= "SELECT * FROM `user` WHERE username ='".mysqli_real_escape_string($con, $u)."'";
        $result = $con->query($query);
        $row_num = $result->num_rows;

        if ($row_num){
            $con->close();
            return false;
        }
        else{
            $con->close();
            return true;
        }
    }

    function insertUser($u,$e,$p){
        include("connection.php");
        $query = "INSERT INTO `user` (`username`, `password`, `date_joined`) VALUES ('".mysqli_real_escape_string($con, $u)."', '".mysqli_real_escape_string($con, $p)."', NOW())";

        $con->query($query);
        $id= $con->insert_id;
        $con->close();
        return $id;
    }

    function insertEAcc($id){
        include("connection.php");
        $query = "INSERT INTO e_account (points, balance) VALUES (0, 0)";
        $con->query($query);
        $eacc_id= $con->insert_id;

        $query = "INSERT INTO has_e_account (user_id, e_account_id) VALUES ('".$id."', '".$eacc_id."')";
        $con->query($query);
        $con->close();
        return $id;
    }

	
	function getGroups(){
		include("connection.php");
		$query = "SELECT * FROM `group`";
		$result = mysqli_query($con,$query);
		if(!$result){
			$_SESSION['message'] = "There are no groups available.";
			$con->close();
			return $_SESSION['message'];
		}
		$con->close();
		return $result;
	}
	
	function getComps(){
		include("connection.php");
		$query = "SELECT * FROM `buy_best`";
		$result = mysqli_query($con,$query);
		if(!$result){
			$_SESSION['message'] = "There are no computers available.";
			$con->close();
			return $_SESSION['message'];
		}
		$con->close();
		return $result;
	}
?>
