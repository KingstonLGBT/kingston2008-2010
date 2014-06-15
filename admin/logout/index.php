<?php
require "$_SERVER[DOCUMENT_ROOT]/include.php" ;
    if(!admin())
        die(header("location: /admin/login/"));
    session_name($session_name);
    session_start();
    sqlconnect();
    $sql_query = "UPDATE `accounts` SET `ip` = null, `sessiontime` = null WHERE `email` = '$_SESSION[email]'";
    mysql_query($sql_query);
    $file = @fopen('/home/kingston/adminlog.txt', 'a');
    @fwrite($file, "Logout  $_SESSION[email]    ".date('H:i:s d-m-Y')."    $_SERVER[REMOTE_ADDR]    $_SERVER[HTTP_USER_AGENT]\r");
    @fclose($file);
    session_destroy();
    setcookie($session_name,'',time()-300);
    printgeneric(": Administration System Logoff");
?>
<h1>Administration System Logoff</h1>
<p>You've been logged out off the administration system.</p>
<?php
    printfooter();
?>