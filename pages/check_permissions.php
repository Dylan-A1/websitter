<?php
function hasPermissions($permission_num) {
	if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name']) || !isset($_SESSION['user_email'])) {
		header("Location:login.php");
		exit();
	}
	if ($_SESSION['role_id'] < $permission_num) {
		header("location:../index.php");
		exit();
	}
}
?>