<?php
    //mail('paul@kingstonlgbt.co.uk','Cron Job Run!',"submenu_update.php has been run.");
    include "./../config.php";
    @mysql_connect("$sql_location","$sql_username","$sql_password") or mail('paul@kingstonlgbt.co.uk','Cron Job failed',"submenu_update.php\rFailed to connect to MySQL");
    mysql_select_db($sql_database);
    $sql_query = "SELECT `ID` from navigation WHERE `name`='committee'";
    $sql_result = @mysql_query($sql_query);
    $sql_entry=mysql_fetch_array($sql_result);
    $id = $sql_entry[ID];
    $sql_query = "DELETE FROM navigation WHERE `id`='$id' AND `subID`!='0'";
    $sql_result = @mysql_query($sql_query);

    $sql_query = "SELECT DISTINCT `year` FROM committee ORDER BY `year`";
    $sql_result = @mysql_query($sql_query);
    $numrows = @mysql_num_rows($sql_result);
    if($numrows > 0)
    {
         $count = 1;
         $datem = date(m);
         $datey = date(Y);
         if($datem < 7) $datey--;
         while($sql_row = mysql_fetch_array($sql_result))
         {
             if($sql_row[year] == $datey) $name = 'Present';
             else $name = $sql_row[year].'-'.($sql_row[year] + 1);
             if($sql_row[year] == $datey) $url = '';
             else $url = "/?year=$sql_row[year]";
             $sql_query2 = "INSERT INTO navigation VALUES('$id','$count','$name','/committee$url','Committee','1')";
             $sql_result2 = @mysql_query($sql_query2);
             $count++;
         }
    }

?>