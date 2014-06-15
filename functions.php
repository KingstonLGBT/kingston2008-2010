<?php
function sqlconnect()
{
    global $sql_connected;
    if($sql_connected == true) return;
    global $sql_location; global $sql_username; global $sql_password; global $sql_database;
    @mysql_connect("$sql_location","$sql_username","$sql_password") or die(require "$_SERVER[DOCUMENT_ROOT]/error/nomysql.php");
    mysql_select_db($sql_database);
    $sql_connected = true;
    return;
}

function printheader($pagetitle,$backgroundcolor = NULL,$extra = NULL)
{
    global $pagetitleprefix;
    global $maincss;
    global $site_offline;
    global $page_offline;
    if($site_offline == true)
        die(require "$_SERVER[DOCUMENT_ROOT]/error/offline.php");
    //if($page_offline == true)
        //die(require_once "$_SERVER[DOCUMENT_ROOT]/error/pageoffline.php");
    require "$_SERVER[DOCUMENT_ROOT]/includes/header.php";
    return;
}

function closeheader()
{
    require "$_SERVER[DOCUMENT_ROOT]/includes/closeheader.php";
    return;
}

function printfooter()
{
    global $mainemailimage;
    global $site_version;
    global $show_version;
    require "$_SERVER[DOCUMENT_ROOT]/includes/footer.php";
    return;
}

function printnavigation()
{
    require "$_SERVER[DOCUMENT_ROOT]/includes/navigation.php";
    return;
}

function curvycorners($items)
{
    include "$_SERVER[DOCUMENT_ROOT]/includes/curvycorners.php";
    return;
}

function printtemplate($nobanner = NULL, $award = NULL)
{
    global $emergencyexit;
    include "$_SERVER[DOCUMENT_ROOT]/includes/template.php";
    return;
}

function printbanner()
{
    /*if(array_key_exists('banner',$_COOKIE) == false) return;
    if($_COOKIE['banner'] == '0') return;*/
    include "$_SERVER[DOCUMENT_ROOT]/includes/banner.php";
    return;
}

function printgeneric($pagetitle,$backgroundcolor = NULL,$extra = NULL)
{
    sqlconnect();
    printheader($pagetitle,$backgroundcolor,$extra);
    //$curvycorners = '"award","navigationarea","mainarea","exitbox","customizebox","incompatable"';
    //curvycorners($curvycorners);
    closeheader();
    printnavigation();
    printtemplate();
    printbanner();
    return;
}

function submenuchild($rowID)
{
    $sql_query = "SELECT subID FROM navigation WHERE `visible` = '1' AND `ID` = '$rowID' AND `subID` > '0'";
    $sql_result = @mysql_query($sql_query);
    $numrows = @mysql_num_rows($sql_result);
    return $numrows;
}

function gettwitter()
{
    $objDOM = new DOMDocument();
    $objDOM->load("http://twitter.com/statuses/user_timeline/50761169.rss");
    $item = $objDOM->getElementsByTagName("item");
    // for each note tag, parse the document and get values for
    // tasks and details tag.

    foreach( $item as $value )
    {
        $titles = $value->getElementsByTagName("title");
        $title  = $titles->item(0)->nodeValue;
        break;      
    }
    $title = substr($title,14);
    //print $title;
    return $title;
}

function twitter()
{
    global $site_root;
    ob_start();
        include "$site_root/includes/twitter";
        $twitter = ob_get_contents();
    ob_end_clean();
    return $twitter;
}

//-----ADMIN FUNCTIONS-----
function admin($session = false)
{
    if(!isset($_COOKIE['lgbtadmin'])) return false;
    global $session_name;
    session_name($session_name);
    @session_start();
    if(isset($_SESSION['email']))
    {
        $email = $_SESSION['email'];
        sqlconnect();
        $sql_query = "SELECT * FROM accounts WHERE `email`='$email'";
        $sql_result = mysql_query($sql_query);
        if(mysql_num_rows($sql_result) < 1) return false;
        $sql_entry=mysql_fetch_array($sql_result);
        if($sql_entry[password] == $_SESSION['password'])
        {
            if($sql_entry[ip] == $_SERVER[REMOTE_ADDR])
            {
                if($sql_entry[http_user_agent] == $_SERVER[HTTP_USER_AGENT])
                {
                    global $session_timeout;
                    $time = strtotime($sql_entry[sessiontime]);
                    if($time > (time()-$session_timeout)||$session == true) return "$sql_entry[id]";
                    else return false;
                }
            }
        }
    }
    return false;
}


function updatesessiontime($firsttime = false)
{
    $id = admin($firsttime);
    if($id == false) return false;
    $currenttime = date('Y-m-d H:i:s');
    $sql_query = "UPDATE `accounts` SET `sessiontime` = '$currenttime' WHERE `id` = '$id'";
    mysql_query($sql_query);
    return true;
}

function printnumberdrop($name,$start,$increase,$end,$default) //prints out number drop down boxes with numbers
//accepts 5 parameters, the form name, the number to start counting from, how much to inrament by each time
{ //is often used for printing date or durations selections
    print('<select name="'.$name.'">');
            for($i=$start; $i<=$end; $i=$i+$increase)
            {
                print("<option");
                if($default == $i) print(' selected="selected" '); //selects default item if match is true
                print(">$i</option>");
            }
    print('</select>');
}

function getnewid($table,$column) //this gets the highest 'id' number thats free in a table
{
    $sql_query = "SELECT MAX($column) FROM $table"; //selects maximum id number in the table
    $sql_result = mysql_query($sql_query);
    $sql_entry=mysql_fetch_array($sql_result);
    $max = $sql_entry["MAX($column)"];
    $max++; //adds one onto the maximum ID
    return "$max"; //returns id number
}
?>