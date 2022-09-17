<?php

if(!isset($_POST['submit'])) {
     // (Replace) : Replace enter_location with the location where you want to send the user if the user didn't accesed this file correctly
     header('location: (enter_location)'); 
     exit();
}

// Require Database

require_once '../db/db.php';

// Get the data from the input

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$pwdr = $_POST['pwdr'];

// Check for empty imputs

if(empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($pwd) || empty($pwdr)) {
     // (Replace) : Replace the location for your needs
     header('location: ../index.php?error=1');
     exit();
}

// Verify the firstame to have only letters

if(!preg_match("/^[a-zA-Z\s]*$/", $firstname)) {
     header('location: ../index.php?err=2');
     exit();
}

// Verify the lastname to have only letters

if(!preg_match("/^[a-zA-Z\s]*$/", $lastname)) {
     header('location: ../index.php?err=2');
     exit();
}

// Verify if the username doesn't contain special characters ( !, @, #)

if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
     header('location: ../index.php?err=3');
     exit();
}

// Verify the email adress

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     header('location: ../index.php?err=4');
     exit();
}

// Check if the password has at least 8 characters

if(strlen($pwd) < 8) {
     header('location: ../index.php?err=5');
     exit();
}

// Check if the password contains all kind of letters and numbers

if(!preg_match("/^[a-zA-Z0-9]*$/", $password)) {
     header('location: ../index.php?err=6');
     exit();
}

if($pwd !== $pwdr) {
     header('location: ../index.php?err=7');
     exit();
}

// Initiate the statement

$stmt = mysqli_stmt_init($conn);

// Check if the username or the email exists

$sql = "SELECT userId FROM users WHERE userUserName = ? or userEmail = ?";

mysqli_stmt_prepare($stmt, $sql);

mysqli_stmt_bind_param($stmt, 'ss', $username, $email);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$result = mysqli_fetch_assoc($result);

if(isset($result['userId'])) {
     header('location: ../index.php?err=8');
     exit();
}



// Create the table

$sql = "CREATE TABLE IF NOT EXISTS users (
     userId int(11) AUTO_INCREMENT PRIMARY KEY,
     userFirstName varchar(255) NOT NULL,
     userLastName varchar(255) NOT NULL,
     userUserName varchar(255) NOT NULL,
     userEmail varchar(255) NOT NULL,
     userPassword longtext
)";

mysqli_query($conn, $sql);


$sql = "INSERT INTO users (userFirstName, userLastName, userUserName, userEmail, userPassword) VALUES (?, ?, ?, ?, ?)";

mysqli_stmt_prepare($stmt, $sql);

// Encrypt the password

$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

mysqli_stmt_bind_param($stmt, 'sssss', $firstname, $lastname, $username, $email, $hashedPwd);

mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

header('location: ../index.php');
exit()