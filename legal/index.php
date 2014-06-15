<?php
    require "$_SERVER[DOCUMENT_ROOT]/include.php" ;
    printgeneric(": Legal Stuff");
?>
    <p>Your use of this website and services offered by it means that you explicitly agree to acknowledge that:</p>

    <p>This website is managed by and maintained by Paul Watson for and on behalf of Kingston University's LGBT Society. Paul Watson does not hold responsibility for any of the content of this website.</p>

    <p>If you choose to join our mailing list, forum or gallery your e-mail address (and name if you choose) is stored on a database. Kingston LGBT's committee or Kingston University Students' Union's LGBT Executive Officer may use this e-mail address to contact you. Your email address is only disclosed to the committee and the LGBT executive officer and is never made known to any other third party unless your explicit permission is given to do otherwise.</p>

    <p>This website is Copyright &#169; 2009 kingstonlgbt.co.uk, all rights reserved. Unless stated, the views expressed on the website, or the forum do not reflect those of Kingston University, Kingston University's Student Union, Kingston University's LGBT Society or Staff, Kingston University's LGBT Students, Kingston University Students' Union LGBT Executive Officer, The National Union of Students, website administrator or any other body or individual, but are those of their individual authors. All pictures, content and design on this website, including staff photos, and the gallery are property of Kingston LGBT, they are not to be used for any purpose without explicit permission from Kingston LGBT. This site is hotlink protected.</p>

    <p>Whilst every effort has been made to ensure all of our information is accurate and up to date, we further assume no responsibility or liability for errors or omissions. We cannot accept any responsibility for the content of any external sites accessed through us.</p>

    <p>Kingston LGBT is the abbreviated name for Kingston University's LGBT Society, which is a society of Kingston University Students' Union.</p>

    <p>For a copy of our constitution click <a class="link" href="constitution.pdf">here</a>.</p>

   <?php $last_modified = filemtime("index.php");
   print "<p>Last updated " . date("l dS F Y", $last_modified) . "</p>"?>

<?php
    printfooter();
?>