<?php
    // Database Connection
    function connecttodb(callable $connectiontasks) {
        $host = "bluecare-server.mysql.database.azure.com";
        $user = "meomyhitnw@bluecare-server";
        $password = "aYawUzzydrAH$$Mx";
        $sql_db = "bluecare-database";

        $connection = @mysqli_connect($host, $user, $pwd, $sql_db);
		require_once("initialise_databases.php");

        // Create table if it does not exist yet
		try {
			# Create Roles table
			@mysqli_query($connection, $create_roles_table);
			$roles_query = "SELECT * FROM roles";
			$roles_result = mysqli_query($connection, $roles_query);
			
			# Add roles
			if(mysqli_num_rows($roles_result) === 0) {
				@mysqli_query($connection, $add_roles);
			}
			
			# Create Patient table
			@mysqli_query($connection, $create_patient_table);
			
			# Create Staff table
			@mysqli_query($connection, $create_staff_table);
		} catch(Exception $error) {
			echo "<p>Error: {$error->getMessage()}</p>";
			mysqli_close($connection);
			die;
		}

        // Calls a function from page
        try {
            @mysqli_query($connection, "START TRANSACTION");
            $connectiontasks($connection);
            @mysqli_query($connection, "COMMIT");
        } catch(Exception $error) {
            echo "<p>Error: {$error->getMessage()}</p>";
            @mysqli_query($connection, "ROLLBACK");
            mysqli_close($connection);
            die;
        }
        // Close SQL Connection
        mysqli_close($connection);
    }
?>