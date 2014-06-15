<?php
    require "$_SERVER[DOCUMENT_ROOT]/include.php" ;
    printheader(": 403 Error");
    $curvycorners = '"mainarea"';
    curvycorners($curvycorners);
?>
</head><body onload="curverycorners('', '', '', '', '', Array('mainarea'));curverycorners('0', '10', '10', '10', '10', Array('submenu'));">
<div id="mainarea" class="mainarea">
<h1>403 - You shouldn't be here!</h1>
    <p>Tut tut your trying to view a page your not authorised to view. Well we can't have any of that!</p>
	</div>
</body>
</html>