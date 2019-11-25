<?php


require_once "../core/configGeneral.php";
session_start(['name' => 'junain']);
session_unset(['name' => 'junain']);
session_destroy(['name' => 'junain']);
echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';

?>