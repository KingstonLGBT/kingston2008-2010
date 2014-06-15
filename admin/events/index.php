<?php
require "$_SERVER[DOCUMENT_ROOT]/include.php" ;
    if(!admin())
        die(header("location: /admin/login/"));
    updatesessiontime();
    $admin = true;
    require "$_SERVER[DOCUMENT_ROOT]/events/index.php"
?>