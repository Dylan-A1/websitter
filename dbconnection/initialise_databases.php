<?php
#Roles table
$create_roles_table = "CREATE TABLE IF NOT EXISTS `roles` (`id` INT AUTO_INCREMENT PRIMARY KEY, `role_name` VARCHAR(10) NOT NULL UNIQUE)";

#Insert roles Guest = 1 ... Admin = 5
$add_roles = "INSERT INTO `roles` (`role_name`) VALUES ('Guest'), ('Patient'), ('Nurse'), ('Doctor'), ('Admin')";

#Patient table
$create_patient_table = "CREATE TABLE IF NOT EXISTS `patients` (`patient_id` INT AUTO_INCREMENT PRIMARY KEY, `first_name` VARCHAR(100) NOT NULL, `last_name` VARCHAR(100) NOT NULL, `date_of_birth` DATE NOT NULL, `email` VARCHAR(100) NOT NULL, `password` VARCHAR(255) NOT NULL, `role_id` INT NOT NULL, FOREIGN KEY (`role_id`) REFERENCES roles(`id`))";

#Staff table
$create_staff_table = "CREATE TABLE IF NOT EXISTS `staff` (`staff_id` INT AUTO_INCREMENT PRIMARY KEY, `username` VARCHAR(50) NOT NULL, `first_name` VARCHAR(100) NOT NULL, `last_name` VARCHAR(100) NOT NULL, `email` VARCHAR(100) NOT NULL, `password` VARCHAR(255) NOT NULL, `role_id` INT NOT NULL, FOREIGN KEY (`role_id`) REFERENCES roles(`id`))";
?>