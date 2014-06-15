<?php
    require_once "$_SERVER[DOCUMENT_ROOT]/include.php" ;
    if($admin == true) {
        if(!admin())
            die(header("location: /admin/login/"));
        updatesessiontime();
    }
    if($_GET['when'] == "past") $title = "Past Events";
    else $title = "Upcoming Events";
    if($admin == true) $title = "Administration: ".$title;
    printgeneric(": $title");
    print("<h1>$title</h1>");
    print('<div id="rss" style="position:absolute;right:20px;top:185px;"><a href="./feed/"><img src="/images/common/rss.gif" alt="RSS Feed" /></a></div>');

    if($admin == true) print('
    <script type="text/javascript">
        function edit(id){
            //alert("hello world");
            window.location = "./edit/?id=" + id;
        }

        function delet(id){
            window.location = "./delete/?id=" + id;
        }
    </script>');

    if($admin == true){
        print('<div style="display:block;text-align:right;font-size:24px;"><input type="submit" value="Add" onclick="window.location=\'./edit/?action=add\'" style="background-color:#00CC00;" /></div>');
    }

    print('<table summary="Event time selector" id="pagesub"><tr><td><a href="./"');
    if($_GET['when'] != "past") print(' style="color:#BBBBBB"');
    print('>Upcoming</a></td><td><a href="./?when=past"');
    if($_GET['when'] == "past") print(' style="color:#BBBBBB"');
    print('>Past</a></td></tr></table>');

    //check page number after total, verify if number, if so when numrows is performed and returns 0 defaults to page 1
    //add LIMIT x,x in variable to use in GET[when]
    //see ideas.txt
    if(ereg('[[:space:]]|[[:alpha:]]|[[:punct:]]',$_GET['page'])||$_GET['page'] < 1||!$_GET['page'])
        $_GET['page'] = 1; //print("invalid");
    $date = date('Y-m-d H:i:s');
    if($_GET['when'] == "past")
        $sql_query_total = "SELECT COUNT(*) as num FROM events WHERE `end` < '$date' AND `visible` = '1'";
    else
        $sql_query_total = "SELECT COUNT(*) as num FROM events WHERE `end` >= '$date' AND `visible` = '1'";
     $itemspage = 10;
     $total = mysql_fetch_array(mysql_query($sql_query_total));
     $total = $total['num'];
     if($_GET['page'] > ceil($total/$itemspage)) $_GET['page'] = 1;
     if($total > $itemspage)
     {
         if($_GET['when'] == "past") $pagelink = './?when=past&amp;page=';
         else $pagelink = './?page=';
         $prev = $_GET['page']-1;
         $next = $_GET['page']+1;
         $last = ceil($total/$itemspage);
         $pageprint .= '<div class="pagenumbers">
                        <a href="'.$pagelink.'1">&lt;&lt;</a> ';
         if($_GET['page'] > 1)
            $pageprint .= '<a href="'.$pagelink.($_GET['page']-1).'">&lt;</a> ';
         else
            $pageprint .= '&lt; ';

         if($last <= 10) // less than 10 items no page scroll
         {
             for($pageno = 1;$pageno <= $last ;$pageno++)
             {
                $pageprint .= '<a href="'.$pagelink.$pageno.'"';
                if($pageno == $_GET['page']) $pageprint .= ' style="color:#BBBBBB"';
                $pageprint .= '>'.$pageno.'</a> ';
             }
         }
         else
         {
             if($_GET[page] < 7) //near begining
             {
                 for($pageno = 1;$pageno <= 10 ;$pageno++)
                 {
                    $pageprint .= '<a href="'.$pagelink.$pageno.'"';
                    if($pageno == $_GET['page']) $pageprint .= ' style="color:#BBBBBB"';
                    $pageprint .= '>'.$pageno.'</a> ';
                 }
                 $pageprint.= "...";
             }
             elseif($_GET['page'] > 6 && $_GET['page'] <= ($last - 5)) //middle
             {
                 $pageprint.= "...";
                 for($pageno = ($_GET['page'] - 5);$pageno < ($_GET['page'] + 5) ;$pageno++)
                 {
                    $pageprint .= '<a href="'.$pagelink.$pageno.'"';
                    if($pageno == $_GET['page']) $pageprint .= ' style="color:#BBBBBB"';
                    $pageprint .= '>'.$pageno.'</a> ';
                 }
                 $pageprint.= "...";
             }
             elseif($_GET['page'] > ($last - 5)) //end
             {
                 $pageprint.= "...";
                 for($pageno = ($last - 9);$pageno <= $last;$pageno++)
                 {
                    $pageprint .= '<a href="'.$pagelink.$pageno.'"';
                    if($pageno == $_GET['page']) $pageprint .= ' style="color:#BBBBBB"';
                    $pageprint .= '>'.$pageno.'</a> ';
                 }
             }
         }

         if($_GET['page'] < $total)
            $pageprint .= '<a href="'.$pagelink.($_GET['page']+1).'">&gt;</a> ';
         else
            $pageprint .= '&gt; ';
         $pageprint .= '<a href="'.$pagelink.$total.'">&gt;&gt;</a></div>'."\n";
         print($pageprint);
     }

    $start = ($_GET['page'] - 1) * $itemspage;
    if($_GET['when'] == "past")
        $sql_query = "SELECT * FROM events WHERE `end` < '$date'  AND `visible` = '1' ORDER BY `start` DESC LIMIT $start,$itemspage";
    else
        $sql_query = "SELECT * FROM events WHERE `end` >= '$date'  AND `visible` = '1' ORDER BY `start` LIMIT $start,$itemspage";
    $sql_result = mysql_query($sql_query);
    $sql_numrows = mysql_num_rows($sql_result);
    if($sql_numrows == 0)
    {
        $_GET['page'] = 1;
        if($_GET['when'] == "past")
            $sql_query = "SELECT * FROM events WHERE `end` < '$date'  AND `visible` = '1' ORDER BY `start` DESC LIMIT 1,$itemspage";
        else
            $sql_query = "SELECT * FROM events WHERE `end` >= '$date'  AND `visible` = '1' ORDER BY `start` LIMIT 1,$itemspage";
        $sql_result = mysql_query($sql_query);
        $sql_numrows = mysql_num_rows($sql_result);
        if($sql_numrows == 0)
        {
            print("<p>There are currently no events planned, please check this page regularly for updates</p>");
            printfooter();
            die();
        }

    }
    print('<br/>');
    while($sql_row = mysql_fetch_array($sql_result))
    {
        $start = strtotime($sql_row['start']);
        $starttime = date('l jS F Y g:ia',$start);
        $startdate = date('d-m-Y',$start);
        $end = strtotime($sql_row['end']);
        $endtime = date('g:ia',$end);
        $enddate = date('d-m-Y',$end);
        if($startdate == $enddate)
            $endtime = date('g:ia',$end);
        else
            $endtime = date('l jS F Y g:ia',$end);
        print('<div class="header">'.$sql_row['name']);
        if($admin == true) print(' <input type="submit" value="Edit" onclick="edit('.$sql_row['id'].')" style="background-color:#CCCC00;" /> <input type="submit" value="Delete" onclick="delet('.$sql_row['id'].')" style="background-color:#CC0000;" /> ');
        print('</div><span class="bold">'.$starttime.' till '.$endtime.'<br />'.$sql_row['location'].'</span><p class="notoppad">'.
        nl2br($sql_row['description'])."</p>\n");
    }
    
    print("$pageprint<br />");
    printfooter();
?>