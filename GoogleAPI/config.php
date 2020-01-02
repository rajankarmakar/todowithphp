<?php
include('vendor/autoload.php');
class Config{
    private $clientId = "1024149819773-mjcs4hdeihj925s67vss6uu6e0c7glo1.apps.googleusercontent.com";
    private $clientSecret = "DgVQuYmgqYz-e0OJWbg1aogK";
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

