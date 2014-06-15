<?php
    require_once "$_SERVER[DOCUMENT_ROOT]/include.php";
    $pagetitle = ': Website Offline';
    require "$_SERVER[DOCUMENT_ROOT]/includes/header.php";
    $curvycorners = '"mainarea"';
    curvycorners($curvycorners);
?>
</head><body onload="curverycorners('', '', '', '', '', Array('mainarea'));curverycorners('0', '10', '10', '10', '10', Array('submenu'));">
<div id="background"><img src="/images/body/background.jpg" alt="Background image"/></div>
<div id="mainarea" class="mainarea">
    <img src="/images/body/logo.png" id="logo" alt="Kingston LGBT logo" title="Kingston LGBT logo" style="position:relative;left:90px;" />
    <hr />
<h1>Website offline</h1>
    <p>We're really sorry we've had to make our website offline. We'll be back online shortly.</p>
	</div>
</body>
</html>