<?php
// requirements
require 'header.php';
include 'conn.php';
?>

<h1>Register</h1>

<form action="#" method="POST">
    <label for="username">Username</label> <input name="username" type="text" required /><br>
    <label for="email">Email</label> <input type="email" name="email" required/><br>
    <label for="password">Password</label><input type="password" name="password" required><br>
   
    <input type="radio" name="userType" value="user"/> <label>user</label>
    <input type="radio" name="userType" value="admin"/> <label>admin</label>
    <input type="submit" value="Submit" name="submit" />
</form>



<?php

if(isset($_POST['submit'])){
    $name = $_POST['username'];
    $email = $_POST['email'];
    $userType = $_POST['userType'];

    $passw = sha1($_POST['password']);
   
    $result = $pdo->query("INSERT INTO `users`(`name`, `email`, `password`, `role`) VALUES ('$name','$email','$passw','$userType')");
    echo ' <a href="login.php"><input type="submit" value="Login Now" name="loginBtn" /> </a>';
}

/// cites from https://www.phptutorial.net/php-tutorial/php-registration-form/

?>

