<?php
    print('<div id="bannerbox" onmouseover="scrollstop()" onmouseout="scrollstart()"><span id="banner1"><span id="nextevent" onclick="loadpage(\'e\')">');
    $date = date('Y-m-d H:i:s');
    $sql_query = "SELECT * from events WHERE `end` >= '$date'  AND `visible` = '1' ORDER BY `end` LIMIT 1";
    $sql_result = mysql_query($sql_query);
    $sql_numrows = mysql_num_rows($sql_result);
    if($sql_numrows == 0)
    {
        //print('There are no upcoming events</span><span id="banner2"><script type="text/javascript">var bannermessage="There are no upcoming events"</script></span>');
        $message = "There are no upcoming events";
    }
    else
    {
        $message = "The next event is ";
        $sql_row=mysql_fetch_array($sql_result);
        $start = strtotime($sql_row[start]);
        $starttime = date('D jS F g:ia',$start);
        $message .= "$sql_row[name] on $starttime";
    }
        $twitter = "Twitter: Kingston LGBT ";
        $twitter .= twitter();

        print($message.'</span><span id="twitter" onclick="loadpage(\'t\')">'.$twitter.'</span></span><span id="banner2"><script type="text/javascript">var bannermessage="'.$message.'"; var twitter="'.$twitter.'"</script></span>');
        /*
        print("$message&nbsp;&nbsp;&nbsp;<span id=\"twitter\">");
        print(substr(twitter(),0,-1));
        print("</span></span>");
        print('<span id="banner2"><script type="text/javascript">var bannermessage="The next event is '.$message.'"</script></span>');
        */
        //print('<span id="banner2"><script type="text/javascript">var bannermessage="This banner will show the latest events and news from Kingston LGBT"</script></span>');
    
    print('</div><hr />'."\n");
    
    //print('<div id="bannerbox" onmouseover="scrollstop()" onmouseout="scrollstart()"><span id="banner1">This banner will show the latest events and news from Kingston LGBT</span><span id="banner2"><script type="text/javascript">var bannermessage="This banner will show the latest events and news from Kingston LGBT"</script></span></div><hr />');

?>