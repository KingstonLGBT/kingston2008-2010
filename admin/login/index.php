<?php
    require "$_SERVER[DOCUMENT_ROOT]/include.php" ;
    if(admin())
        die(header("location: /admin/"));
    session_name($session_name);
    session_start();
    sqlconnect();
    if(isset($_POST['email']))
    {
        if(empty($_POST['email'])) $status = "Email field blank";
        elseif(empty($_POST['password'])) $status = "Password field blank";
        else
        {
            $email = $_POST['email'];
            $sql_query = "SELECT email,password FROM accounts WHERE `email`='$email' AND `enabled` = '1'";
            $sql_result = mysql_query($sql_query);
            if(mysql_num_rows($sql_result) < 1) $status="Your details are incorrect";
            $sql_entry=mysql_fetch_array($sql_result);
            if(md5($_POST['password']) == $sql_entry['password'])
            {
                if(!isset($status))
                {
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['password'] = md5($_POST['password']);
                    $sql_query = "UPDATE `accounts` SET `ip` = '$_SERVER[REMOTE_ADDR]', `http_user_agent` = '$_SERVER[HTTP_USER_AGENT]' WHERE `email` = '$_POST[email]'";
                    mysql_query($sql_query);
                    updatesessiontime(true);
                    $file = @fopen('/home/kingston/adminlog.txt', 'a');
                    @fwrite($file, "Login  $_POST[email]    ".date('H:i:s d-m-Y')."    $_SERVER[REMOTE_ADDR]    $_SERVER[HTTP_USER_AGENT]\r");
                    @fclose($file);
                    header("location: /admin/");
                }
            }
            else
                 $status = "Your details are incorrect";
        }
    }
    printgeneric(": Administration System Login",NULL,'<style type="text/css">td{padding-bottom:5px;}</style>');
?>

<h1>Administration System Login</h1>
<form action="./" method="post">
    <div class="center" style="margin:1em 1em">
    <?php if(isset($status)) print('<div id="error" class="error">'.$status.'</div>') ?>
    <table summary="Login form" style="position:relative;left:190px;">
    <tr><td><label for="email" style="display:block;text-align:right">E-mail: </label></td><td><input type="text" name="email" id="email"/></td></tr>
    <tr><td><label for="password">Password: </label></td><td><input type="password" name="password" id="password"/></td></tr></table>
    <input type="submit" value="Login"/>
    </div>
</form>
<?php
    printfooter();
?>