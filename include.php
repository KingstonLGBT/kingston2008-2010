<?php
//echo 'magic_quotes_gpc = ' . ini_get('magic_quotes_gpc') . "\n";
//
//    print(ini_get('magic_quotes_gpc'));
//   If (ini_set('magic_quotes_gpc', 'On') == false)
//   {
//       print('failed<br/>');
//   }
//error_reporting(E_ALL & ~E_NOTICE);

    $includes = array('config.php',
                      'functions.php'
                      );

    foreach($includes as $include)
        require "$_SERVER[DOCUMENT_ROOT]/$include";
?>