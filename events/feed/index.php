<?php
    require "$_SERVER[DOCUMENT_ROOT]/include.php" ;
    header("Content-Type: application/xml; charset=ISO-8859-1");
    print('<?xml version="1.0" encoding="ISO-8859-1"?>');
    ?>
    <rss version="2.0">
        <channel>
            <title>Kingston LGBT Events</title>
            <link>http://kingstonlgbt.co.uk/events</link>
            <description>Latest events from Kingston LGBT</description>
<?php
    if($site_offline != true)
    {
        sqlconnect();
        $date = date('Y-m-d');
        $sql_query = "SELECT * FROM events WHERE `end` >= '$date'  AND `visible` = '1' ORDER BY `start` LIMIT 0,19";
        $sql_result = mysql_query($sql_query);
        while($sql_row = mysql_fetch_array($sql_result))
        {
            $start = strtotime($sql_row[start]);
            $starttime = date('l jS F Y g:ia',$start);
            $end = strtotime($sql_row[end]);
            $endtime = date('g:ia',$end);
            print("<item>
                <title>$sql_row[name] - $starttime</title>
                <link>http://kingstonlgbt.co.uk/events</link>
                <description><![CDATA[$sql_row[location] - ".nl2br($sql_row[description])."]]></description>
                </item>
            ");
        }
    }
    else
        print("<item>
                <title>The Kingston LGBT website is offline</title>
                <description>We're really sorry we've had to make our website offline. We'll be back online shortly.</description>
                </item>");
?>
</channel>
</rss>
