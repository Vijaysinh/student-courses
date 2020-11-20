
<?php
require_once 'core/init.php';

function escape($string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

//echo checkInput('\\\\\<script>///$#Q%%#\\\\alert(1);</script>');exit;
function checkInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return escape($input);
}    

?>
