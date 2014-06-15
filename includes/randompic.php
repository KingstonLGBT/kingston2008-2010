<?php
    $directory = "$_SERVER[DOCUMENT_ROOT]/images/random/";
    //print("$_SERVER[DOCUMENT_ROOT]");

    $openeddir = opendir($directory);
    $piccount = '-1';
    $filenames = array();
    while ($file = readdir($openeddir))
    {
        if ($file != '.' && $file != '..')
        {
            array_push($filenames, $file);
            $piccount++;
        }
    }
    closedir($openeddir);
    //print($piccount);
    $ran = rand(0,$piccount);
    //$pics = count($filenames);
    //print("Ran: $ran Count: $piccount Name: $filenames[$ran] Array no: $pics");
    print('<img src="/images/random/'. $filenames[$ran] .'" class="randomimage" id="randomimage" alt="Random image of LGBT members" />');
    print('<script type="text/javascript">var pictures = Array("'.implode($filenames, '","').'")</script>')
    //print(implode($filenames, ','));
?>