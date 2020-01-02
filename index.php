<?php
session_start();
include("GoogleAPI/config.php");
$gHandler = new Config();
if(isset($_SESSION['access-token'])){
    header("Location: admin/index.php");
    die();
}else{
    unset($_SESSION['access-token']);
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register To TODO App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="regitration-container">
    <div class="welcome-heading">
        <h1 class="title"> Welcome to TODO app </h1>
        <p class="description"> In order to access this app just login via GOOGLE </p>
    </div>
    <div class="login">
        <a href="<?php $gHandler->googleLoginUrl(); ?>"> <img src="inc/upload/login-with-google-button.png">
        </a>
    </div>
</div>
</body>
</html>
