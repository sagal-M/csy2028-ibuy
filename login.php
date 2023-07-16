<?php
session_start();

require 'header.php';
require 'conn.php';




$_SESSION['loggedin'] = false;
?>


<h1>Login</h1>

<form action="#" method="POST">
    <label for="email">Email: </label> <input type="email" name="email" required /><br>
    <label for="password">Password: </label><input type="password" name="password" required><br>
    <input type="submit" value="Login" name="login" />
</form>


<?php
// the login page backend code has been cited from : https://www.w3schools.com/howto/howto_css_login_form.asp

if (isset($_POST['login'])) {
    $result = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
    $userInfo = [
        'email' => $_POST["email"],
        'password' => sha1($_POST['password'])
    ];
    $result->execute($userInfo);
    $data = $result->fetchAll();
    foreach($data as $value){
        $_SESSION['username'] = $value['name'];
        $_SESSION['userType'] = $value['role'];
        $_SESSION['userID'] = $value['id'];
    }


    $countRows = $result->rowCount();
    if ($countRows > 0) {
        $_SESSION['loggedin'] = true;
        
        
    }
else {
    echo "Email or Password do not match. <br/>";
}

};

if (isset($_SESSION['username'])) {
    echo 'Welcome Back, '.$_SESSION['username'];
}
else{
   echo  '<a href="register.php"><button>Register Now!</button></a>';
}
?>