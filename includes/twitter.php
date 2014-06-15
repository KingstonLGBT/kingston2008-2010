<?php
        require "./../config.php";
        chdir($site_root);
        require "./functions.php";
        $current = twitter();
        $twitter = gettwitter();
        if($current != $twitter && $twitter != "")
        {
            $file = fopen('./includes/twitter', 'w');
            fwrite($file, $twitter);
            fclose($file);
            mail($emailtwitter, "Twitter Update", "Kingston LGBT ".$twitter, "From: twitter@kingstonlgbt.co.uk");
            mail('paul@kingstonlgbt.co.uk', "Twitter Update", "Kingston LGBT ".$twitter, "From: twitter@kingstonlgbt.co.uk");
        }
?>