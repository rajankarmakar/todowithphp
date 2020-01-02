<?php
session_start();
include("../GoogleAPI/config.php");
$obj = new Config();
if(isset($_GET['logout'])){
    unset($_SESSION['access-token']);
    $obj->gClient->revokeToken();
    session_destroy();
    header("Location: ../index.php");
    exit();
}

