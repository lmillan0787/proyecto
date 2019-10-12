<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}


class loginModelo extends mainModel{

    
protected function iniciar_sesion_modelo($datos){
    $sql=mainModel::conectar()->prepare("select * from dat_usr where des_usr=:des_usr and clave=:clave"); 

    $sql->bindParam(':des_usr',$datos['des_usr']);
    $sql->bindParam(':clave',$datos['clave']);
    $sql->execute();
    return $sql;

   }

}