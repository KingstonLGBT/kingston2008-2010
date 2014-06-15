<?php
    /*  ERROR CODES
     * 0: No Post Date
     * 1: Login successful
     * 2: email is empty
     * 3: password is empty
     * 4: details incorrect
     */

    require "$_SERVER[DOCUMENT_ROOT]/include.php" ;
    session_name($session_name);
    session_start();
    sqlconnect();
    $result = "0";
    if(isset($_POST['email']))
    {
        if(empty($_POST['email'])) $result = "2";
        elseif(empty($_POST['password'])) $result = "3";
        else
        {
            $email = $_POST['email'];
            $sql_query = "SELECT email,password FROM accounts WHERE `email`='$email' AND `enabled` = '1'";
            $sql_result = mysql_query($sql_query);
            if(mysql_num_rows($sql_result) < 1) $result="4";
            $sql_entry=mysql_fetch_array($sql_result);
            if(md5($_POST['password']) == $sql_entry['password'])
            {
                if($result == "0")
                {
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['password'] = md5($_POST['password']);
                    $sql_query = "UPDATE `accounts` SET `ip` = '$_SERVER[REMOTE_ADDR]', `http_user_agent` = '$_SERVER[HTTP_USER_AGENT]' WHERE `email` = '$_POST[email]'";
                    mysql_query($sql_query);
                    updatesessiontime(true);
                    $file = @fopen('/home/kingston/adminlog.txt', 'a');
                    @fwrite($file, "Login  $_POST[email]    ".date('H:i:s d-m-Y')."    $_SERVER[REMOTE_ADDR]    REMOTE LOGIN\r");
                    @fclose($file);
                    $result = "1";
                }
            }
            else
                 $result = "4";
        }
    }
    print $result
?>