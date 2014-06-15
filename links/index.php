<?php
    require "$_SERVER[DOCUMENT_ROOT]/include.php" ;
    printgeneric(": Links");
    print("<h1>Links</h1>
        <p>Here is a directory of useful services within the local area to Kingston.</p>\n");
    $sql_query = "SELECT * FROM `links` ORDER BY `id`";
    $sql_result = mysql_query($sql_query);
    //print(mysql_num_rows($sql_result));
    if(mysql_num_rows($sql_result) == '0')
        print("<p>We don't have any links on our database at the moment.</p>");
    else
    {
        while($sql_row = mysql_fetch_array($sql_result))
        {
            print('<span class="header">'.$sql_row[name].'</span><br />');
            if(!empty($sql_row[link]))
                print('<b>Link:</b><a href="'.$sql_row[link].'" class="link" rel="external">'.$sql_row[link].'</a><br />');
            if(!empty($sql_row[telephone]))
                print('<b>Telephone:</b>'.$sql_row[telephone].'<br />');
          // $sql_row[description] = str_replace("&", "&amp;", $sql_row[description]);
            print('<b>Description:</b>'.nl2br($sql_row[description]).'<br /><br />'."\n");
        }
        print('<script type="text/javascript">
        externalLinks();
            </script>'."\n");
    }
?>
<?php
    printfooter();
?>