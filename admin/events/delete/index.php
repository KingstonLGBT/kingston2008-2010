<?php
    require "$_SERVER[DOCUMENT_ROOT]/include.php" ;
    if(!admin())
        die(header("location: /admin/login/"));
    updatesessiontime();

    if($_POST[yes] == "Yes"){
        //$sql_query = "DELETE FROM events WHERE `id`='$_POST[id]'";
        $who = admin();
       $sql_query = "SELECT `email` FROM `accounts` WHERE `id`='$who'";
       $sql_result = mysql_query($sql_query);
       $sql_entry=mysql_fetch_array($sql_result);
       $who = $sql_entry[email];
           
        $sql_query = "UPDATE events SET `visible`='0', `whodelete`='$who' WHERE `id`=$_POST[id]";
        $sql_result = mysql_query($sql_query);
    }

    if(!empty($_GET[id]))
    {
        $sql_query = "SELECT id,name FROM events WHERE `id`='$_GET[id]'";
        $sql_result = mysql_query($sql_query);
        $sql_entry=mysql_fetch_array($sql_result);
    }

    printgeneric(": Administration System: Delete Event");

    print("<h1>Delete Event</h1>");
    
    if($sql_entry[id] > 0){
        print('<p>Are you sure you want to delete the following event?</p>
        <p class="bold">'.$sql_entry[name].'</p>');
        print('<div><form name="delete" action="./" method="POST">
        <input type="submit" value="Yes" name="yes" /> <input type="submit" value="No" name="no" /><input type="hidden" name="id" value="'.$sql_entry[id].'" />
        </form></div>');
    } elseif($_POST[yes] == "Yes" && $sql_result == true){
        print('<p>Event Deleted</p><a href="./../" class="link">Back</a>');
    } else {
        print('<p>No or none existing event ID was passed</p>');
    }
    //print($_POST[yes]);
    printfooter();
?>