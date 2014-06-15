<?php
/*<div id="navigationarea" class="navigationarea">
    <table>
        <tr><td><a href="/">Home</a></td></tr>
        <tr><td><a href="/">About us is a long page</a></td></tr>
        <tr><td><a href="/">Events</a></td></tr>
    </table>
</div> */
    print('<div id="navigationarea" class="navigationarea">');
    $sql_query = "SELECT * FROM navigation WHERE `visible` = '1' AND `subID` = '0' ORDER BY `ID`";
    $sql_result = @mysql_query($sql_query) or print("<!--SQL query error #1-->");
    $numrows = @mysql_num_rows($sql_result) or print("<!--SQL query error #2-->");
    if($numrows == '0')
        print('Error: Unable to display navigation');
    else
    {
        print('<table summary="Navigation bar">');
        while($sql_row = mysql_fetch_array($sql_result))
        {
            $nav_id = "nav_".$sql_row[ID];  //$nav_id = substr($sql_row[url],1);
            print('<tr id="'.$nav_id.'"');
            if(submenuchild($sql_row[ID]) > 0)
                print(' onmouseover="submenushow(\'sub_'.$sql_row[ID].'\')" onmouseout="submenuhide(\'sub_'.$sql_row[ID].'\')"');
            print('><td><a href="'.$sql_row[url].'"');
            if($_SERVER[REQUEST_URI] == $sql_row[url]||$_SERVER[REQUEST_URI] == "$sql_row[url]/"||$_SERVER[REQUEST_URI] == "$sql_row[url]/index.php"||$_SERVER[REQUEST_URI] == "$sql_row[url]index.php")
                print(' style="background-color:#E658C9"');
            print(">$sql_row[name]</a></td></tr>\r");
        }
        print('</table>');
    }
    print("</div>\r");

    $sub_last= 0;
    $sql_query = "SELECT * FROM navigation WHERE `visible` = '1' AND `subID` > '0' ORDER BY `ID`,`subID`";
    $sql_result = @mysql_query($sql_query) or print("<!--SQL query error #3-->");
    $numrows = @mysql_num_rows($sql_result) or print("<!--SQL query error #4-->");
    $subs = array();
    while($sql_row = mysql_fetch_array($sql_result))
        {
            if($sql_row[ID] != $sub_last && $sub_last != 0)
                print('</table></div>'."\r");
            if($sql_row[ID] != $sub_last)
                print('<div id="sub_'.$sql_row[ID].'" class="submenu" onmouseover="submenushow(\'sub_'.$sql_row[ID].'\')" onmouseout="submenuhide(\'sub_'.$sql_row[ID].'\')"><table summary="Submenu">');
            print("<tr><td><a href=\"$sql_row[url]\">$sql_row[name]</a></td></tr>");
            if($sql_row[ID] != $sub_last)
                array_push($subs,$sql_row[ID]);
            $sub_last = $sql_row[ID];

        }
    if($sub_last != 0)
        print('</table></div>'."\r");

    $sql_query = "SELECT DISTINCT `year` FROM committee ORDER BY `year`";
    $sql_result = @mysql_query($sql_query) or print("<!--SQL query error #5-->");
    $numrows = @mysql_num_rows($sql_result) or print("<!--SQL query error #6-->");
    if($numrows > 0)
    {
        print('<div id="sub_committee" class="submenu" onmouseover="submenushow(\'sub_committee\')" onmouseout="submenuhide(\'sub_committee\')"><table summary="Submenu">');
        while($sql_row = mysql_fetch_array($sql_result))
        {
            print("<tr><td><a href=\committee\?year=$sql_row[year]>");

           print("</a></td></tr>");
        }
        array_push($subs,'sub_committee');
        print('</table></div>'."\r");
        $sub_last++;
    }

        if($sub_last > 0)
        {
            print('<script type="text/javascript">');
            foreach($subs as $subitem)
                print("submenulocation('nav_$subitem','sub_$subitem');");
            print('</script>');
        }

?>