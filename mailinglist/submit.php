<?php
    require "$_SERVER[DOCUMENT_ROOT]/include.php";
    session_start();
    if(empty($_POST['email']))
         die(header("location: /mailinglist/?error=noemail"));
    elseif(($_SESSION['security_code'] != $_POST['security_code']) || (empty($_SESSION['security_code'])))
        die(header("location: /mailinglist/?error=captcha"));
    else
    {
        $_GET[p] = "subscribe";
        chdir('/home/kingston/public_html/maillist/');
        //$_SERVER['DOCUMENT_ROOT'] = "/home/kingston/public_html/maillist/";
        require "/home/kingston/public_html/maillist/index.php";
    }
?>