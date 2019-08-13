<?php

    if($peticionAjax){
        require_once "../core/mainModel.php";
    }else{
        require_once "./core/mainModel.php";
    }
    class disciplinaModelo extends mainModel{
        protected function agregar_disciplina($datos){
            $sql=mainModel::conectar()->prepare("INSERT INTO dat_dis(des_dis,cod_tip_even,cod_cat) VALUES (:des_dis,:cod_tip_even,:cod_cat)");
            $sql->bindParam(":des_dis",$datos['des_dis']);
            $sql->bindParam(":cod_tip_even",$datos['cod_tip_even']);
            $sql->bindParam(":cod_cat",$datos['cod_cat']);
            $sql->execute();
            return $sql;
        }
    }