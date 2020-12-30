<?php

    include('config.php');
    $login_button = '';
    if(isset($_GET["code"])) //checkingg user auth code
    {
        $token=$google_client->fetchAccessTokenWithAuthCode($_GET["code"]); //setting fetched code as token
        if(!isset($token['error'])) //if code is accessed
        {
            $google_client->setAccessToken($token['access_token']); //fetching token
            $_SESSION['access_token'] = $token['access_token']; //creating session of token
            $google_service = new Google_Service_Oauth2($google_client); //google service objects
            $data = $google_service->userinfo->get(); //fetching user info
        
            if(!empty($data['given_name']))
            {
                $_SESSION['user_first_name']=$data['given_name'];
            }
            if(!empty($data['family_name']))
            { 
                $_SESSION['user_last_name']=$data['family_name'];
            }
            if(!empty($data['email']))
            {
                $_SESSION['user_email']=$data['email'];
            }
            if(!empty($data['gender']))
            {
                $_SESSION['user_gender']=$data['gender'];
            }
            if(!empty($data['picture']))
            {
                $_SESSION['user_image']=$data['picture'];
            }
        }
    } 
    
if(!isset($_SESSION['access_token']))
{
    //logout using time
      /*  $_SESSION['start_time'] = time();
       $_SESSION['expire_time'] = $_SESSION['start_time'] + (1 * 60);
       
       echo $_SESSION['start_time'].'<br>';
       echo $_SESSION['expire_time'].'<br>';*/

       //logout by date
       $_SESSION['start_date'] = date('d');
       $_SESSION['expire_date'] = $_SESSION['start_date'] + 1;
       
      /*echo $_SESSION['start_date'].'<br>';
       echo $_SESSION['expire_date'].'<br>';*/

    $login_button = '<a href="'.$google_client->createAuthUrl().'"
    style="background: linear-gradient(90deg, red 10%, yellow 45%, green 35%, rgba(0,212,255,1) 100%);width:200px;box-shadow:2px -1px 6px 0px;align:center;margin-top:100px;margin-left:550px;" class="btn btn-block text-white font-weight-bolder p-2 w-10" >Login with google</a>';

}


    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="font-weight-bolder" align="center" style="margin-top:60px">Login using Google account</h1><?php// echo date('d-m-Y');
       //$date=date('d-m-Y');
        ?>
    </div>
    <div class="card">
    <?php
    if($login_button == '')
    {
        //echo '<script>alert("token available.")</script>'; 
        

     /* echo $_SESSION['start_time'].'<br>';
       echo $_SESSION['expire_time'].'<br>';*/

       // $now=time();
       // echo $now;

       $today=date('d');
       //echo $today;


/* session expire using time
        if($now > $_SESSION['expire_time'])
        {
            echo '<script>alert("session expired, login again to continue.")</script>';    
            header('location:logout.php');
                
        }*/ 


        if($today == $_SESSION['expire_date']) /* session expire by date*/ 
        {
            echo '<script>alert("session expired, login again to continue.")</script>';    
            header('location:logout.php');
                
        }

        echo '<div class="card-header text-center">welcome user</div><div class="card-body">';
        echo '<img  scr="'.$_SESSION['user_image'].'" class="img-fluid img-thumbnail" height="200px" width="200px"><p>profile pic</p>';
        echo '<p align="center">Name : '.$_SESSION['user_first_name'].'&nbsp;'.$_SESSION['user_last_name'].'</p>';
        echo '<br><p align="center">Email : '.$_SESSION['user_email'].'</p>';
        echo '<p align="center"><a href="logout.php" class="btn btn-warning mt-3 mb-5" >logout</a></p></div>';

        
    }
    
    else
    {
        echo '<div class="center">'.$login_button.'</div>';
    }

    ?>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>