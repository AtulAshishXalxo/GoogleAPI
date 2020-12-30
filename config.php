<?php
    session_start(); //starting session

    require_once 'vendor/autoload.php'; //including google client library
    $google_client=new Google_Client(); //creating object for google api
    $google_client->setClientId('494968168358-64sgddso0ccbnpnv1gctone2h7f4ottn.apps.googleusercontent.com'); //setting OAuth Client Id
    $google_client->setClientSecret("Bsb4dCGEqo7CZkWiKozjE_sy"); //setting OAuth seceret key
    $google_client->setRedirectUri("http://localhost:8080/GoogleLogin/login.php"); //setting OAuth redirect uri
    $google_client->addScope("email");// fetching email
    $google_client->addScope('profile'); //fetching profile 
?>