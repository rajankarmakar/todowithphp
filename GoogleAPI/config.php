<?php
include('vendor/autoload.php');
class Config{
    private $clientId = "747830735251-f06bgqu265cm14q52iq4g21l0iaks3gs.apps.googleusercontent.com";
    private $clientSecret = "1Dc85pHhSaoEIMNYwKgDrlUf";
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

