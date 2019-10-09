 <?php

if ($peticionAjax) {
    require_once "../models/loginModelo.php";
} else {
    require_once "./models/loginModelo.php";
}


class loginControlador extends loginModelo{

    public function iniciar_sesion_controlador(){

$des_usr=mainModel::limpiar_cadena($_POST['des_usr']);
$clave=mainModel::limpiar_cadena($_POST['clave']);

$clave=mainModel::encryption($clave);

$datosLogin=[

"des_usr"=>$des_usr,
"clave"=>$clave
];
    
$consultaUsuario=loginModelo::iniciar_sesion_modelo($datosLogin);
    
if($consultaUsuario->rowCount()==1){
    session_start(['name'=>'junain']);
    $_SESSION['des_usr']=$des_usr;
    $url=SERVERURL."home/";

return $urlLocation=  '<script> window.location="'.$url.' "</script>' ;

}else{
$alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Datos Inválidos",
                    "Texto" => "El nombre de usuario y contraseña ingresados no son válidas",
                    "Tipo" => "error"
                ];
                return mainModel::sweet_alert($alerta);
}
    }



} 