<?php
include('vendor/autoload.php');
class Config{
    private $clientId = "1024149819773-mddr44g1lneer57s571isd5lm9tc792b.apps.googleusercontent.com";
    private $clientSecret = "2oM3QEzYARAlRPIyrATUTyeN";
    private $loginUrl;
    public $gClient;

    public function __construct()
    {
        $this->gClient = new Google_Client();
        $this->gClient->setClientId($this->clientId);
        $this->gClient->setClientSecret($this->clientSecret);
        $this->gClient->setApplicationName("Simple ToDo App With PHP");
        $this->gClient->setRedirectUri("http://todowithphp.herokuapp.com/GoogleAPI/g-callback.php");
        $this->gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
        $this->loginUrl = $this->gClient->createAuthUrl();
    }

    public function googleLoginUrl(){
        echo $this->loginUrl;
    }

}

