<?php

declare(strict_types=1);
session_start();


require 'vendor/autoload.php';
$secret = 'XVQ2UIGO75XRUKJO';


$link = \Sonata\GoogleAuthenticator\GoogleQrUrl::generate($_SESSION['username'], $secret, 'Finalhackathon');

$g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();

if(isset($_POST['submit']))
{
    $code = $_POST['pass-code'];

    if ($g->checkCode($secret, $code)) 
    {
         header("Location: index.php");
    } 
    else 
    {
        echo "INVALID CODE!!! TRY AGAIN!! \n";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Two Factor auth</title>
        <link rel="stylesheet" type="text/css" href="bootstap.min.css"/>
    </head>
    <style>
        h1 {
        text-align: center;
        }
    </style>
    <body>
        <div class="container well">
            <h1>Two Factor authentication using Google Authenticator<br><br>
            <img src="<?=$link;?>" class="centre"></h1><br>
            <div style="width: 50%; margin: 10px auto;">
            <p class="text-justify">
                Please install <strong>Google authenticator</strong> app in your phone, open it and then
                scan the above barcode to add this application. After you have added this application enter the code you see in the
                Google authenticator app into the below input box to complete login process.
            </p>
            <form action="" method="post" class="from-horizontal">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon-addon-diff-color">
                            <span class="glyphicon-glyphicon-lock"></span>
                        </div>
                        <input type="text" autocomplete="off" class="form-control" name="pass-code" placeholder="Enter Code">
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="Login" class="btn btn-warning btn-block" name="submit">
                </div>
            </form>
            </div>    
        </div>
        <div style="position: fixed; bottom: 10px; right: 10px; color:green;">
            <strong>
                By Team noobs
            </strong>
        </div>
    </body>
</html>