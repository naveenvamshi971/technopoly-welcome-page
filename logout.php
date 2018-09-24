<?php
session_start();
session_unset();
session_destroy();
$_SESSION=array();
header('Refresh:0; url=index.html');
echo '<script language="javascript">';
echo 'alert("logout successful")';
echo '</script>';
?>
<html>
<script>
    history.pushState(null, null, location.href);
    window.onpopstate = function ()
    {
        history.go(1);
    };
</script>

</html>