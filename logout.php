<?php
    include('config.php');
    $google_client->revokeToken(); //resetting OAuth token
    session_destroy();
    header('location:login.php'); 
?>