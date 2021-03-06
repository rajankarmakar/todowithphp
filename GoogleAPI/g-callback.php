<?php
session_start();
include "config.php";
include "../admin/class.database.php";


        if(isset($_GET['code'])) {
            $myCon = new Config();
            $token = $myCon->gClient->fetchAccessTokenWithAuthCode($_GET['code']);
            $_SESSION['access-token'] = $token;

            $oAuth = new Google_Service_Oauth2($myCon->gClient);
            $userData = $oAuth->userinfo_v2_me->get();
            $_SESSION['name'] = $userData['name'];
            $_SESSION['picture'] = $userData['picture'];
            if(isset($_SESSION['access-token'])) {
                $userName = $userData['name'];
                $email = $userData['email'];
                $picture = $userData['picture'];
                $db = new Database();


                $emailSql = "SELECT * FROM users WHERE email=?";
                $result = $db->conn->prepare($emailSql);
                $result->execute([$email]);
                $result->setFetchMode(PDO::FETCH_ASSOC);
                $eObj = $result->fetch();
                if ($eObj['email'] == $email) {
                    header("Location: ../admin/index.php");
                } else {
                    $sql2 = "INSERT INTO users (name, email, picture) VALUES (?, ?, ?)";
                    $db->conn->prepare($sql2)->execute([$userName, $email, $picture]);
                    header("Location: ../admin/index.php");
                }
            }else{
                header("Location: ../index.php");
            }
        }




