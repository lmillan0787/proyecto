<?php

    if ($peticionAjax) {
        require_once "../core/mainModel.php";
    } else {
        require_once "./core/mainModel.php";
    }


    class loginModelo extends mainModel
    {
        protected function iniciar_sesion_modelo($datos)
        {
            $sql = mainModel::conectar()->prepare("SELECT *  FROM dat_usr WHERE des_usr=:des_usr AND clave=:clave AND cod_estat=1");
            $sql->bindParam(':des_usr', $datos['des_usr']);
            $sql->bindParam(':clave', $datos['clave']);
            $sql->execute();
            return $sql;
        }
    }
