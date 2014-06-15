<?php
    require "$_SERVER[DOCUMENT_ROOT]/include.php";
    @mysql_connect("$sql_location","$sql_username","$sql_password");
    mysql_select_db($sql_database);
    $result = mysql_query("show table status like 'committee'");
    while($array = mysql_fetch_array($result)) {
    $total = $array[Data_length]+$array[Index_length];
    echo '
    Table: '.$array[Name].'<br />
    Data Size: '.$array[Data_length].'<br />
    Index Size: '.$array[Index_length].'<br />
    Total Size: '.$total.'<br />
    Total Rows: '.$array[Rows].'<br />
    Average Size Per Row: '.$array[Avg_row_length].'<br />
    Update_time: '.$array[Update_time].'<br />
    <br />
    ';
    }
?>