<?php
    require "$_SERVER[DOCUMENT_ROOT]/include.php" ;
    $datem = date('m');
    $datey = date('Y');
    if($datem < 7) $datey--;
    if(!isset($_GET['year'])) $_GET['year'] = $datey;
    elseif($_GET['year'] < '2000' || $_GET['year'] > '2100') $_GET['year'] = $datey;
    if($_GET['year'] == $datey) $title = "Present Committee";
    else $title = "Committee $_GET[year]-".($_GET['year']+1);
    printgeneric(": $title",NULL,'<link href="/committee/committee.css" rel="stylesheet" type="text/css" />');
    print('<h1>'.$title.'</h1>');
  

    $sql_query = "SELECT DISTINCT `year` FROM committee ORDER BY `year`";
    $sql_result = @mysql_query($sql_query) or print("<!--SQL query error #3-->");
    $numrows = @mysql_num_rows($sql_result) or print("<!--SQL query error #4-->");
    if($numrows == '0')
    {
        print('<p>Oops we\'ve had a problem fetching the committee data!</p>');
        die(printfooter());
    }
    print('<table summary="Committe years" id="pagesub"><tr>');
    while($sql_row = mysql_fetch_array($sql_result))
    {
        print('<td><a href="./');
        if($sql_row['year'] != $datey) print("?year=$sql_row[year]");
        print('"');
        if($sql_row['year'] == $_GET['year']) print(' style="color:#888888"');
        print('>');
        if($sql_row['year'] == $datey)
            print('Present');
        else
            print($sql_row['year'].'-'.($sql_row['year']+1));
        print('</a></td>');
    }
    print('</tr></table><br />');

    $sql_query = "SELECT * FROM committee WHERE `year`='$_GET[year]' ORDER BY `order`";
    $sql_result = @mysql_query($sql_query) or print("<!--SQL query error #3-->");
    $numrows = @mysql_num_rows($sql_result) or print("<!--SQL query error #4-->");
    if($numrows == '0')
    {
        $sql_query = "SELECT * FROM committee WHERE `year`='$datey' ORDER BY `order`";
        $sql_result = @mysql_query($sql_query) or print("<!--SQL query error #5-->");
        $numrows = @mysql_num_rows($sql_result) or print("<!--SQL query error #6-->");
        if($numrows == '0'){
            print('This years committee information hasn\'t been uploaded!');
            die(printfooter());
        }
    }
    //print('<table summary="committee">');
    $group = '';
    while($sql_row = mysql_fetch_array($sql_result))
    {
        if($group != $sql_row['group'])
        {
            if($group != '') print('</table>');
            print($sql_row['group'].'<br /><table class="committee" summary="'.$sql_row['group'].'">');
        }
        if(!$sql_row['picture']) $sql_row['picture'] = "pcs.jpg";
        print('<tr><td style="width:200px;text-align:center;"><img src="/images/committee/'.$sql_row['picture'].'" alt="Picture of '.$sql_row['name'].'" class="committee_pic" /></td>'."\r");
        print('<td><a name="'.$sql_row['name'].'"></a><span class="bold">Name: </span><span class="grey">'.$sql_row['name'].'</span><br />');
        print('<span class="bold">Position: </span><span class="grey">'.$sql_row['position'].'</span><br />');
        print('<span class="bold">Role: </span><span class="grey">'.nl2br($sql_row['role']).'</span><br />');
        print('<span class="bold">Bio: </span><span class="grey">'.nl2br($sql_row['bio']).'</span><br />');
        if($_GET['year'] == $datey)
        print('<span class="bold">E-mail: </span><img src="/images/addresses/'.$sql_row['email'].'" alt="'.$sql_row['name'].'\'s e-mail address" class="email" /></td></tr>');
        $group = $sql_row['group'];
        //print("</tr>\r");
    }
    print('</table>');

    printfooter();
?>