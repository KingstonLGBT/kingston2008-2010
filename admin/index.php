<?php
    require "$_SERVER[DOCUMENT_ROOT]/include.php" ;
    if(!admin())
        die(header("location: /admin/login/"));
    updatesessiontime();
    printgeneric(": Administration System",null,'<style type="text/css">
    #admintable td{text-align:center}
    #admintable a{text-decoration:none}
    </style>');
?>
<h1>Administration System</h1>
<!--<div style="margin-left:50px;text-align:center">-->
<table id="admintable" summary="Admin functions" style="width:100%">
    <tr><td>
        <a href="./events" class="link">
            <img src="/images/admin/events.png" alt="Events Icon" /><br />
            Events Management System
        </a>
    </td><td>
        <a href="./logout" class="link">
            <img src="/images/admin/logoff.png" alt="Events Icon" /><br />
            Logoff
        </a>
    </td></tr>
</table>
<br />
<?php
    printfooter();
?>