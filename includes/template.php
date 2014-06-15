<div id="award" class="award"><a href="/awards"><img src="/images/body/award.png" alt="Higher Education Society of the Year" title="Higher Education Society of the Year" /></a></div>
<div id="exitbox" class="exitbox" onclick="emergencyexit();location.href='<?php print($emergencyexit) ?>';" onmouseover="emergencyexithover('1')" onmouseout="emergencyexithover('0')"><p><a href="<?php print($emergencyexit) ?>" onclick="emergencyexit()">
<img src="/images/body/exit.png" alt="Emengency Exit" title="Emergency Exit" id="eeimg"/>Emergency Exit</a></p>
</div>
<div id="incompatable" class="incompatable" onclick="location.href='/browser';"><a href="/browser">Please enable JavaScript</a></div><script type="text/javascript">browserhandle();</script>
<div id="twitterbox" class="twitterbox" onclick="location.href='http://twitter.com/kingstonlgbt';"><a href="http://twitter.com/kingstonlgbt"><img src="http://twitter-badges.s3.amazonaws.com/follow_bird_us-a.png" alt="Follow kingstonlgbt on Twitter"/></a></div>
<div id="facebookbox" class="facebookbox" onclick="location.href='http://www.facebook.com/group.php?v=wall&amp;gid=2222708813';"><a href="http://www.facebook.com/group.php?v=wall&amp;gid=2222708813"><img src="/images/body/facebook.png" alt="View our facebook group"/></a></div>

<?php if(admin()) include "$_SERVER[DOCUMENT_ROOT]/includes/adminbox.php";?>
<div id="mainarea" class="mainarea">
<img src="/images/body/logo.png" id="logo" alt="Kingston LGBT logo" title="Kingston LGBT logo" />
<?php include "$_SERVER[DOCUMENT_ROOT]/includes/randompic.php";?>
<hr />
