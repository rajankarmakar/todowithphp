<?php
session_start();
include "config.php";
include "../admin/class.database.php";
class HandleGoogleRequest {
    private $email;
    public function __construct()
    {
        $this->showDashBoard();
    }

    public function showDashBoard(){
        if(isset($_GET['code'])) {
            $myCon = new Config();
            $token = $myCon->gClient->fetchAccessTokenWithAuthCode($_GET['code']);
            $_SESSION['access-token'] = $token;
        }
            $oAuth = new Google_Service_Oauth2($myCon->gClient);
            $userData = $oAuth->userinfo_v2_me->get();

            if(isset($_SESSION['access-token'])) {
                $userName = $userData['name'];
                $this->email = $userData['email'];
                $picture = $userData['picture'];
                $db = new Database();


                $emailSql = "SELECT * FROM users WHERE email=?";
                $result = $db->conn->prepare($emailSql);
                $result->execute([$this->email]);
                $result->setFetchMode(PDO::FETCH_ASSOC);
                $eObj = $result->fetch();
                if ($eObj['email'] == $this->email) {
                    header("Location: ../admin/index.php");
                } else {
                    $sql2 = "INSERT INTO users (name, email, picture) VALUES (?, ?, ?)";
                    $db->conn->prepare($sql2)->execute([$userName, $this->email, $picture]);
                    header("Location: ../admin/index.php");
                }
            }else{
                header("Location: ../index.php");
            }


    }


}
new Config();
$obj = new HandleGoogleRequest();
$obj->showDashBoard();
