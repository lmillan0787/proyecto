<?php


require_once "../core/configGeneral.php";
session_start();
$_SESSION=session_destroy();
echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';

?>