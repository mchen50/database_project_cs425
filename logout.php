<?php
	$logout = isset($_GET["logout"]) ? $_GET["logout"] : '';
	$message = isset($message) ? $message : '';

	if ($logout==1) {
		session_destroy();
		$message="You have been logged out. Have a nice day!";
	}
?>
