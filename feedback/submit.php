<?php
   /*Feedback System 2.0
      *uses captcha  
    * *Check form has data
    * *New messages on accept and fail
    */

    require "$_SERVER[DOCUMENT_ROOT]/include.php";
    session_start();
    if($_POST['message'] == "")
        die(header("location: /feedback/?error=nomessage"));
    if(strlen($_POST['message']) < 15)
        die(header("location: /feedback/?error=tooshort"));
    if(($_SESSION['security_code'] != $_POST['security_code']) || (empty($_SESSION['security_code'])))
        die(header("location: /feedback/?error=captcha"));
    if($_POST['name'] == "")
        $name = "[anonymous]";
    else
        $name = $_POST['name'];
    if($_POST['email'] == "")
        $email = "[anonymous]";
    else
        $email = $_POST['email'];
    if(empty($_POST['subject']))
        $subject = "[no subject]";
    else
        $subject = $_POST['subject'];
    $message = $_POST['message'];
    $body = "Name: $name\re-mail: $email\rSubject: $subject\rMessage:\r$message";
    $subject = stripslashes($subject);
    $subject = strip_tags($subject);
    $body = stripslashes($body);
    $body = strip_tags($body);
    $headers = "From: feedback@kingstonlgbt.co.uk\r\n";
    if($_POST['email'] != "")
        $headers .= "Reply-To: $email";
    $success = mail($feedback_address,$subject,$body, $headers);
    //$success = false;
    if($success == true) {
        $status = "Submitted";
    } else {
        $status = "Submit Failed";
    }
    printgeneric(": Feedback $status");
    print("<h1> Feedback $status</h1>");

if($success == true)
{
    if($_POST['name'])
        $name = ' '.$_POST['name'];
    else
        $name = "";
    print("<p>Thanks$name, your feedback has been sent to us.</p>");
    if($_POST['email'] != "")
        print("<p>We'll get back to you via the e-mail address you provided us.</p>");
}
else
    print("<p>We're really sorry, we've had a problem with our system and it's not sent the feedback to us.</p>
    <p>We have generated a copy of your feedback you just submitted below. You can either save it and try again another time or e-mail it to us</p>
    <p style=\"font-family:monospace\">".nl2br($body)."</p>");
printfooter();
?>
