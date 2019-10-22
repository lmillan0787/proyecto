<?php

    if($peticionAjax){
        require_once "../core/mainModel.php";
    }else{
        require_once "./core/mainModel.php";
    }

    class personaModelo extends mainModel{
        protected function agregar_persona_modelo($datos){
            $sql=mainModel::conectar()->prepare("INSERT INTO dat_per");
        }
    }