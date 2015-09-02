<?php
	include("queries.php");

	function test_add_restaurant(){
		if(addRestaurant("Bobbys","123 Main Street","Chicago","IL")) echo 'Add Restaurant: <font color="green">Passed</font><br>';
		else echo "Add Restaurant: Failed<br>";
	}
	
	function test_delete_restaurant(){
		if(deleteRestaurant(1,1)) echo 'Delete Restaurant: <font color="green">Passed</font><br>';
		else echo "Delete Restaurant: Failed<br>";
	}
	
	function test_create_review(){
		if(createReview('This is a great restaurant! My boyfriend and I loved it!')) echo 'Create Review: <font color="green">Passed</font><br>';
		else echo "Create Review: Failed<br>";
	}

	function test_add_review(){
		if(addReview(1,1,1)) echo 'Add Review: <font color="green">Passed</font><br>';
		else echo "Add Review: Failed<br>";
	}
	
	function test_remove_review(){
		if(removeReview(1,1,1)) echo 'Remove Review: <font color="green">Passed</font><br>';
		else echo "Remove Review: Failed<br>";
	}

	function test_delete_review(){
		if(deleteReview(1)) echo 'Delete Review: <font color="green">Passed</font><br>';
                 else echo "Delete Review: Failed<br>";
	}
	
	function test_delete_all_reviews(){
		if(deleteAllReviews()) echo 'Delete All Reviews: <font color="green">Passed</font><br>';
		else echo 'Delete All  Reviews: Failed<br>';
	}

	function test_rate_review(){
		if(rateReview(1,1,1)) echo 'Rate Review: <font color="green">Passed</font><br>';
		else echo "Rate Review: Failed<br>";
	}
	
	function test_remove_rate_review(){
		if(removeRateReview(1,1)) echo 'Remove Rate Review: <font color="green">Passed</font><br>';
		else echo 'Remove Rate Review: Failed';
	}

	function test_update_rate_review(){
		if(updateRateReview(1,1,1)) echo 'Update Rate Review: <font color="green">Passed</font><br>';
		else echo 'Update Rate Review: Failed';
	}

	function test_rate_restaurant(){
		if(rateRestaurant(1,1,5)) echo 'Rate Restaurant: <font color="green">Passed</font><br>';
		else echo "Rate Restaurant: Failed<br>";
	}

	function test_update_rate_restaurant(){
		if(updateRateRestaurant(1,1,3)) echo 'Update Rate Restaurant: <font color="green">Passed</font><br>';
		else echo 'Update Rate Restaurant: Failed<br>';
	}
	
	function test_delete_rate_restaurant(){
		if(deleteRateRestaurant(1,1)) echo 'Delete Rate Restaurant <font color="green">Passed</font><br>';
		else echo 'Delete Rate Restaurant: Failed<br>';
	}
	
	function test_create_activity(){
		if(createActivity(1,'Created Restaurant')) echo 'Create Activity: <font color="green">Passed</font><br>';
		else echo 'Create Activity: Failed<br>';
	}
		
	function test_add_activity(){
		if(addActivity(1,1)) echo 'Add Activity: <font color="green">Passed</font><br>';
		else echo "Add Activity: Failed<br>";
	}
	
	function test_remove_activity(){
		if(removeActivity(1,1)) echo 'Remove Activity: <font color="green">Passed</font><br>';
		else echo 'Remove Activity: Failed<br>';
	}

	function test_delete_activity(){
		if(deleteActivity(1)) echo 'Delete Activity: <font color="green">Passed</font><br>';
		else echo 'Delete Activity: Failed<br>';
	}
	
	function test_delete_all_activity(){
		if(deleteAllActivity()) echo 'Delete All Activity: <font color="green">Passed</font><br>';
		else echo 'Delete Activity: Failed<br>';
	}
	
	function test_add_member(){
		if(addMember(1,1)) echo 'Add Member: <font color="green">Passed</font><br>';
		else echo 'Add Member: Failed<br>';
	}
	
	function test_remove_member(){
		if(removeMember(1,1)) echo 'Remove Member: <font color="green">Passed</font><br>';
		else echo 'Remove Member: Failed<br>';
	}
	
	function test_create_activity_rule(){
		if(createActivityRule(1,3)) echo 'Create Activity Rule: <font color="green">Passed</font><br>';
		else echo 'Create Activity Rule: Failed<br>';
	}

	function test_update_activity_rule(){
		if(updateActivityRule(1,5)) echo 'Update Activity Rule: <font color="green">Passed</font><br>';
		else echo "Update Activity Rule: Failed<br>";
	}
	
	function test_delete_activity_rule(){
		if(deleteActivityRule(1)) echo 'Delete Activity Rule: <font color="green">Passed</font><br>';
		else echo 'Delete Activity Rule: Failed<br>';
	}

	function test_change_rank_rule(){
		if(changeRankRule()) echo "Change Rank Rule: Passed<br>";
		else echo "Change Rank Rule: Failed<br>";
	}

	function test_add_group_role(){
		if(addGroupRole()) echo "Add Group Role: Passed<br>";
		else echo "Add Group Role: Failed<br>";
	}
	
?>
