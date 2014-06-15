<?php
    if(isset($_POST[password]))
    {
        print(md5($_POST[password]).'<br /><a href="">Reset</a>');
        return;
    }
?>

<form name="form" action="" method="POST">
    <input type="password" name="password" value="" /><input type="submit" value="Send" />
</form>