<?php
	function getRestaurants(){
		include("connection.php");
		$query = "SELECT * FROM `yellp`";
		$result = mysqli_query($con,$query);
		if(!mysqli_num_rows($result)){
			$_SESSION['error'] = "There are no restaurants in the found.";
			$con->close();
			return false;
		}
		$con->close();
		return $result;
	}

	function findRestaurant($n){
		include("connection.php");
		$query = "SELECT * FROM `yellp` WHERE name LIKE '%".$n."%'";
		$result = mysqli_query($con,$query);
		if(mysqli_num_rows($result) == 0){
			$con->close();
			return false;
		}
		$con->close();
		return $result;
	}
	
	function addRestaurant($n,$str,$c,$sta){
		if(restaurantExists($n)){
			return false;
		}
		$id = getGroupIdFromName('yellp');
		include ("connection.php");
		$query = "INSERT INTO `yellp` (group_id,city,state,street,name) VALUES ('".$id."','".$c."','".$sta."','".$str."','".$n."')";
		if(mysqli_query($con,$query)){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}
	
	function getGroupIdFromName($n){
		include("connection.php");
		$query = "SELECT group_id FROM `group` WHERE name='".$n."'";
		$result = mysqli_query($con,$query);
		if(mysqli_num_rows($result) == 0){
			$con->close();
			return -1;
		}else{
			$con->close();
			$row = mysqli_fetch_row($result);
			return $row[0];
		}
			
	}

	function restaurantExists($n){
		include("connection.php");
		$query = "SELECT * FROM `yellp` WHERE name='".$n."'";
		$result = mysqli_query($con,$query);
		if(mysqli_num_rows($result) > 0){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}
	
	function deleteRestaurant($rest_id,$group_id){
		include("connection.php");
		$query = "DELETE FROM `yellp` WHERE `group_id`=".$group_id." AND restaurant_id=".$rest_id."";
		if(mysqli_query($con,$query)){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}

	function createReview($content){
		include("connection.php");
		$query = "INSERT INTO `review` (content) VALUES ('".$content."')";
		$result = mysqli_query($con,$query);
		if($result){
			$con->close();
			return $result;
		}
		$con->close();
		return $result;
	}
	
	function addReview($user_id,$rest_id,$review_id){
		include("connection.php");
		$query1 = "INSERT INTO `make_review` (user_id,review_id) VALUES (".$user_id.",".$review_id.")";
		$query2 = "INSERT INTO `has_review` (group_id,res_id,review_id) VALUES (1,".$rest_id.",".$review_id.")";
		$result1 = mysqli_query($con,$query1);
		$result2 = mysqli_query($con,$query2);
		if($result1 && $result2){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}
	
	function removeReview($user_id,$rest_id,$review_id){
		include("connection.php");
		$query1 = "DELETE FROM `make_review` WHERE user_id=".$user_id."";
		$query2 = "DELETE FROM `has_review` WHERE res_id=".$rest_id." AND review_id=".$review_id."";
		$result1 = mysqli_query($con,$query1);
		$result2 = mysqli_query($con,$query2);
		if($result1 && $result2){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}
	
	function deleteReview($review_id){
		include("connection.php");
		$query = "DELETE FROM `review` WHERE id=".$review_id."";
		$result = mysqli_query($con,$query);
		if($result){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}

	function deleteAllReviews(){
		include("connection.php");
		$query1 = "DELETE FROM `review` WHERE id>0";
		$query2 = "ALTER TABLE `review` AUTO_INCREMENT=1";
		$result1 = mysqli_query($con,$query1);
		$result2 = mysqli_query($con,$query2);
		if($result1 && $result2){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}

	function rateReview($user_id,$review_id,$up_down){
		include("connection.php");
		$query = "INSERT INTO `make_r_thumb` (user_id,review_id,up_down) VALUES (".$user_id.",".$review_id.",".$up_down.")";
		$result = mysqli_query($con,$query);
		if($result){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}

	function removeRateReview($user_id,$review_id){
		include("connection.php");
		$query = "DELETE FROM `make_r_thumb` WHERE user_id=".$user_id." AND review_id=".$review_id."";
		$result = mysqli_query($con,$query);
		if($result){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}

	function updateRateReview($user_id,$review_id,$up_down){
		include("connection.php");
		$query = "UPDATE `make_r_thumb` SET up_down=".$up_down." WHERE user_id=".$user_id." AND review_id=".$review_id."";
		$result = mysqli_query($con,$query);
		if($result){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}

	function rateRestaurant($user_id,$rest_id,$rating){
		include("connection.php");
		$query = "INSERT INTO `rates_restaurant` (user_id,rest_id,rating) VALUES (".$user_id.",".$rest_id.",".$rating.")";
		$result = mysqli_query($con,$query);
		if($result){
			$con->close();
			return true;
		}
		$con->close(); 
		return false;
	}

	function updateRateRestaurant($user_id,$rest_id,$rating){
		include("connection.php");
		$query = "UPDATE `rates_restaurant` SET rating=".$rating." WHERE user_id=".$user_id." AND rest_id=".$rest_id."";
		$result = mysqli_query($con,$query);
		if($result){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}

	function deleteRateRestaurant($user_id,$rest_id){
		include("connection.php");
		$query = "DELETE FROM `rates_restaurant` WHERE user_id=".$user_id." AND rest_id=".$rest_id."";
		$result = mysqli_query($con,$query);
		if($result){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}
	
	function createActivity($group_id,$type){
		include("connection.php");
		$query = "INSERT INTO `activity` (group_id,type,date_time) VALUES (".$group_id.",'".$type."', NOW())";
		$result = mysqli_query($con,$query);
		if($result){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}

	function addActivity($user_id,$activity_id){
		include("connection.php");
		$query = "INSERT INTO `has_activity` (user_id,activity_id) VALUES (".$user_id.",".$activity_id.")";
		$result = mysqli_query($con,$query);
		if($result){
			$con->close();
			return true;
		}
		$con->close();	
		return false;
	}

	function removeActivity($user_id,$activity_id){
		include("connection.php");
		$query = "DELETE FROM `has_activity` WHERE user_id=".$user_id." AND activity_id=".$activity_id."";
		$result = mysqli_query($con,$query);
		if($result){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}

	function deleteActivity($activity_id){
		include("connection.php");
		$query = "DELETE FROM `activity` WHERE id=".$activity_id."";
		$result = mysqli_query($con,$query);
		if($result){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}
	
	function deleteAllActivity(){
		include("connection.php");
		$query1 = "DELETE FROM `activity` WHERE id>0";
		$query2 = "ALTER TABLE `activity` AUTO_INCREMENT=1";
		$result1 = mysqli_query($con,$query1);
		$result2 = mysqli_query($con,$query2);
		if($result1 && $result2){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}

	function addMember($group_id,$user_id){
		include("connection.php");
		$query = "INSERT INTO `has_member` (group_id,user_id) VALUES (".$group_id.",".$user_id.")";
		$result = mysqli_query($con,$query);
		if($result){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}

	function isMember($group_id,$user_id){
		include("connection.php");
		$query = "SELECT * FROM `has_member` WHERE group_id=".$group_id." AND user_id=".$user_id."";
		$result = mysqli_query($con,$query);
		if(mysqli_num_rows($result) >0){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}

	function removeMember($user_id,$group_id){
		include("connection.php");
		$query = "DELETE FROM `has_member` WHERE group_id=".$group_id." AND user_id=".$user_id."";
		$result = mysqli_query($con,$query);
		if($result){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}

	function createActivityRule($rule_id,$points){
		include("connection.php");
		$query = "INSERT INTO `activity_rule` (type,points) VALUES (".$rule_id.",".$points.")";
		$result = mysqli_query($con,$query);
		if($result){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}
	
	function updateActivityRule($rule_id,$points){
		include("connection.php");
		$query = "UPDATE `activity_rule` SET points=".$points." WHERE id=".$rule_id."";
		$result = mysqli_query($con,$query);
		if($result){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}
	
	function deleteActivityRule($rule_id){
		include("connection.php");
		$query = "DELETE FROM `activity_rule` WHERE id=".$rule_id."";
		$result = mysqli_query($con,$query);
		if($result){
			$con->close();
			return true;
		}
		$con->close();
		return false;
	}

	function changeRankRule(){
		return false;
	}

	function addGroupRole(){
		return false;
	}
?>
