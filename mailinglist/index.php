<?php
    //if(!file_exists("$_SERVER[DOCUMENT_ROOT]/include.php")) die("Critical file missing.");
    require "$_SERVER[DOCUMENT_ROOT]/include.php" ;
    printgeneric(": Mailing List");
?>
<script type="text/javascript" src="./email.js"></script>
<h1>Mailing List</h1>
<p class="nobottompad">Please enter your e-mail address below to subscribe. You'll be sent a confirmation e-mail, if you do not reply to this you will not be signed up to our mailing list.</p>
<p class="notoppad">Details on how to unsubscribe are on the footers of e-mails sent to you, you can also click here, otherwise send an e-mail to <img src="<?php print($mainemailimage) ?>" alt="Our e-mail address" title="Our e-mail address" class="emailimg"/></p>

<form action="./submit.php" method="post" name="mailinglist" onsubmit="return checkemail();">
    <!--<div class="redbox">Your e-mail address is invalid</div>-->
<div class="center">
    <?php
    if($_GET['error'] == 'noemail') print('<div id="error" class="error">You\'ve not entered an email address</div>');
    elseif($_GET['error'] == 'captcha') print('<div id="error" class="error">You\'ve enter Captcha incorrectly</div>');
    // <!--<div id="error" class="error" style="visibility:hidden"><img src="/images/common/reject.gif" alt="Reject image" /></div>-->
    ?>
    <label for="email">E-mail:</label>&nbsp;<input type="text" name="email" value="" id="email" style="margin-bottom:2px"/><br />
    <label for="captcha">Captcha:</label><img src="/includes/captcha.php?characters=3&amp;width=60" alt="captcha" class="emailimg"/> <input id="security_code" name="security_code" type="text" maxlength="3" size="3"/> &nbsp;<input type="submit" value="Submit" /><br />
    Please type the code in the image into the text box.
    <input type="hidden" name="emailconfirm" value="" id="emailconfirm"/>
    <input type="hidden" name="subscribe" value="" />
    <input type="hidden" name="list[3]" value="signup"/>
    <input type=hidden name="htmlemail" value="1"/>
    </div><br />
</form>
<?php
    //print($_SERVER[REQUEST_URI]);
    printfooter();
?>