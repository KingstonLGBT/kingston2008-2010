<?php
    require "$_SERVER[DOCUMENT_ROOT]/include.php" ;
    if(!admin()) die(header("location: /admin/login/"));
    updatesessiontime();
    if(isset($_POST[cancel])) header("location: /admin/events/");

    if(isset($_POST[submit]))
    {
       $name = $_POST[name];
       $stime = strtotime($_POST[starty].'-'.$_POST[startm].'-'.$_POST[startd].' '.$_POST[starth].':'.$_POST[startn].':00');
       $etime = strtotime($_POST[endy].'-'.$_POST[endm].'-'.$_POST[endd].' '.$_POST[endh].':'.$_POST[endn].':00');
       $location = $_POST[location];
       $discription = $_POST[discription];
       if($_POST[name] == "") $status = "Event name is blank<br />";
        elseif(strlen($_POST[name]) < 6) $status .= "Event name too short<br />";

        if(!checkdate($_POST[startm], $_POST[startd], $_POST[starty])) $status .= "Start date not valid <br />";
        if(!is_numeric($_POST[starth]) || !is_numeric($_POST[startn]) || $_POST[starth] > 23 || $_POST[startn] > 59) $status .= "Start time not valid<br />";
        if(!checkdate($_POST[endm], $_POST[endd],$_POST[endy])) $status .= "End date not valid<br />";
        if(!is_numeric($_POST[endh]) || !is_numeric($_POST[endn]) || $_POST[endh] > 23 || $_POST[endn] > 59) $status .= "End time not valid<br />";
        if($stime >= $etime) $status .= "Start time after end time";

        if($_POST[location] == "") $status .= "Location is blank<br />";
        elseif(strlen($_POST[location]) < 4) $status .= "Location too short<br />";
        if($_POST[discription] == "") $status .= "Discription is blank<br />";
        elseif(strlen($_POST[discription]) < 6) $status .= "Discription too short<br />";


       if($status == "")
       {
           $newstime = date("Y-m-d H:i:s",$stime);
           $newetime = date("Y-m-d H:i:s",$etime);
           $newname = htmlspecialchars(strip_tags($_POST[name]));
           $newlocation = htmlspecialchars(strip_tags($_POST[location]));
           $newdiscription = htmlspecialchars(strip_tags($_POST[discription], '<b><i><u><a>'));
           $who = admin();
           $sql_query = "SELECT `email` FROM `accounts` WHERE `id`='$who'";
           $sql_result = mysql_query($sql_query);
           $sql_entry=mysql_fetch_array($sql_result);
           $who = $sql_entry[email];

           if($_GET[action] == "add" || $_POST[add] == "true")
           {
               $newid = getnewid("events","id");
               $sql_query = "INSERT INTO events VALUES('$newid','$newname','$newstime','$newetime','0','$newlocation','$newdiscription','','0','1','$who','','')";
           }
           else
           {
               $sql_query = "UPDATE events SET `name`='$newname', `start`='$newstime', `end`='$newetime', `location`='$newlocation', `description`='$newdiscription', `whoedit`='$who' WHERE id='$_REQUEST[id]'";
           }
           $sql_result = mysql_query($sql_query);
           if($sql_result == 1) return(header("location: /admin/events/"));
           else{
               printgeneric(": Administration System: $action Event");
               print('<h1>Administration System: '.$action.' Event</h1>
                     <p>There was an error in '.$action.'ing the event. Please try again.</p><p><a href="./../" class="link">Back</a></p>');
               return(printfooter());
           }
           //print ($sql_query);
           // 1 = successful
       }
   }

    if($_GET[action] == "add" || $_POST[add] == "true")
    {
        $action = "Add";
        if(!isset($_POST[submit]))
        {
            $stime = strtotime(date("Y-m-d",time() + 86400).' 18:00:00');
            $etime = strtotime(date("Y-m-d",time() + 86400).' 20:00:00');
        }
    }
    else {
        $action = "Edit";
        if(!isset($_POST[submit]))
        {
            $sql_query = "SELECT * FROM events WHERE `id`='$_GET[id]'";
            $sql_result = mysql_query($sql_query);
            $sql_entry=mysql_fetch_array($sql_result);
            $name = $sql_entry[name];
            $stime = strtotime($sql_entry[start]);
            $etime = strtotime($sql_entry[end]);
            $location = $sql_entry[location];
            $discription = $sql_entry[description];
        }
    }
    printgeneric(": Administration System: $action Event");
   
    if(!isset($_GET[id]) && !isset($_POST[id]) && $_GET[action] != "add" && !isset($_POST[add]))
    {
        print('<h1>Administration System: <?php print($action) ?> Event</h1>
        <p>No or none existing event ID was passed.</p>
        ');
    }
    else{
        print('<h1>Administration System: '.$action.' Event</h1>
        <form method="post" action="./">
            <input name="id" type="hidden" value="'.$_REQUEST[id].'" />
            ');
            if(isset($status)) print('<div class="error">'.$status.'</div>');
            if($_GET[action] == "add" || $_POST[add] == "true") print('<input name="add" type="hidden" value="true" />');
           print ('
            <table summary="Events Form">
            <tr><td><label>Name:</label></td><td><input name="name" type="text" value="'.$name.'" size="62"/></td></tr>
            <tr><td><label>Start Time:</label></td><td>Day:');printnumberdrop("startd",1,1,31,date(d,$stime));print(' Month:');printnumberdrop("startm",1,1,12,date(m,$stime));print(' Year:');printnumberdrop("starty",2009,1,2020,date(y,$stime));print(' - Hour:');printnumberdrop("starth",0,1,23,date(H,$stime));print(' Minute:');printnumberdrop("startn",0,1,59,date(i,$stime));print('</td></tr>
            <tr><td><label>End Time:</label></td><td>Day:');printnumberdrop("endd",1,1,31,date(d,$etime));print(' Month:');printnumberdrop("endm",1,1,12,date(m,$etime));print(' Year:');printnumberdrop("endy",2009,1,2020,date(y,$etime));print(' - Hour:');printnumberdrop("endh",0,1,23,date(H,$etime));print(' Minute:');printnumberdrop("endn",0,1,59,date(i,$etime));print('</td></tr>
            <tr><td><label>Location:</label></td><td><input name="location" type="text" value="'.$location.'" size="62"/></td></tr>
            <tr><td><label>Description:</label></td><td><textarea rows="5" cols="60" name="discription">'.$discription.'</textarea></td></tr>
            </table>
            <input name="submit" value="'.$action.'" type="submit" /> <input name="cancel" value="Cancel" type="submit" />
        </form>');
    }//<input name="startn" type="text" value="'.date(i,$stime).'" maxlength="2" size="1"/>
    printfooter();
    ?>