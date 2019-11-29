<?php


require_once "../core/configGeneral.php";
session_start(['name' => 'junain']);
session_unset();
session_destroy();   

echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';

?>