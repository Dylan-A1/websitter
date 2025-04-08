<?php
# Check the user can access the page
session_start();
$required_permission = 3;
require_once('database/check_permissions.php');
hasPermissions($required_permission);
require_once('connectToDB.php');
# Display the page
echo("start page here");

# Connect to Database
connecttodb(function ($connection) {
	# Testing it works
	$result = @mysqli_query($connection, "SELECT * FROM roles");
	while($row = mysqli_fetch_array($result)) {
		echo "\r\n" . implode(" ", $row) . "\r\n";
	}
});

?>