<?php
    require_once "$_SERVER[DOCUMENT_ROOT]/include.php";
    printheader(": Website Offline",'#FF1540');
    $curvycorners = '"award","navigationarea","mainarea","exitbox","customizebox","incompatable"';
    curvycorners($curvycorners);
    closeheader();
    printtemplate('1');
?>
<h1>Uh-Oh we've got a problem!</h1>
<p>We've had a slight technical hitch on our server and unfortunatly this has cause our site to stop
    functioning for a short time!</p>

<p>Please bare with us we'll be back in no time!</p>

   <!--Error: Cannot connect to MySQL-->
<?printfooter();?>