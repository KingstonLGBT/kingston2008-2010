<?php
    require "$_SERVER[DOCUMENT_ROOT]/include.php" ;
    printgeneric(": Feedback");
    /*Requires update...
     * Error message to be styled in box
     * Use Ajax to check Captcha is correct
     */
?>
<script type="text/javascript" src="validate.js" ></script>
<h1>Feedback</h1>
    <p>Got something to say about the way we run? Want to give an oppinion on an event?</p>
    <p>Fill in the form below to send feedback. You can submit data anonymously by not filling in the name or e-mail boxes.</p>
    <p>However if you do wish to recieve a reply we need an e-mail address.</p>
    <?php
        if($_GET[error] == "nomessage") print('<div id="error" class="error">You\'ve not entered a message</div>');
        elseif($_GET[error] == "captcha") print('<div id="error" class="error">You\'ve entered captcha incorrectly.</div>');
        elseif($_GET[error] == "tooshort") print('<div id="error" class="error">Message too short.</div>');
    ?>
<form name="feedback" action="submit.php" method="post" onsubmit="return checkFields();">

                    <table summary="Feedback form">
                        <tr><td><label for="name">Name (Optional): </label></td><td><input type="text" name="name" size="30" id="name"/></td></tr>
                         <tr><td><label for="email">E-mail (Optional): </label></td><td><input type="text" name="email" size="30" id="email"/></td></tr>
                         <tr><td><label for="subject">Subject: </label></td><td><input type="text" name="subject" size="30" id="subject"/></td></tr></table>
                    <label for="message">Message:</label><br /><textarea name="message" id="mesage" rows="10" cols="90"></textarea><br />
                    <label for="security_code">Captcha:</label> <img src="/includes/captcha.php?characters=3" alt="captcha" class="emailimg"/> <input id="security_code" name="security_code" type="text" maxlength="3" size="3"/> Please type the code in the image into the text box.<br />
                    <input type="submit" value="Submit" style="margin-top:10px; padding-left:5px; padding-right:5px"/>

            </form>
<?php
    printfooter();
?>