function checkFields()
{
    if (document.feedback.message.value=="")
    {
        alert("You've not entered a message.");
        return false;
    }
    else if(document.feedback.security_code.value=="")
    {
        alert("You've not entered the security code.");
        return false;
    }
    //setTimeout('clear_form()', 100);
    return true();
}
function clear_form()
{
    document.feedback.reset();
}