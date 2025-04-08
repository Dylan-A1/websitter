<?php
#Roles table
$create_roles_table = "CREATE TABLE IF NOT EXISTS `roles` (`id` INT AUTO_INCREMENT PRIMARY KEY, `role_name` VARCHAR(10) NOT NULL UNIQUE)";

#Insert roles - Guest = 1 ... Admin = 5
$add_roles = "INSERT INTO `roles` (`role_name`) VALUES ('Guest'), ('Patient'), ('Nurse'), ('Doctor'), ('Admin')";

#User table
$create_user_table = "CREATE TABLE IF NOT EXISTS `users` (`user_id` INT AUTO_INCREMENT PRIMARY KEY, `first_name` VARCHAR(100) NOT NULL, `last_name` VARCHAR(100) NOT NULL, `date_of_birth` DATE NOT NULL, `email` VARCHAR(100) NOT NULL, `password` VARCHAR(255) NOT NULL, `role_id` INT NOT NULL, FOREIGN KEY (`role_id`) REFERENCES roles(`id`), `created_at` datetime DEFAULT current_timestamp())";

#OTP table
$create_otp_table = "CREATE TABLE IF NOT EXISTS `otp` (`email` varchar(255) NOT NULL, `pass` varchar(255) NOT NULL, `timestamp` datetime NOT NULL)"

?>