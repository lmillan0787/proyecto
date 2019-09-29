<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class personaModelo extends mainModel
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function agregar_persona_modelo($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO dat_per(cod_nac,ced,nom,ape,fec_nac,cod_gen) VALUES (:cod_nac,:ced,:nom,:ape,:fec_nac,:cod_gen)");
        $sql->bindParam(":cod_nac", $datos['cod_nac']);
        $sql->bindParam(":ced", $datos['ced']);
        $sql->bindParam(":nom", $datos['nom']);
        $sql->bindParam(":ape", $datos['ape']);
        $sql->bindParam(":fec_nac", $datos['fec_nac']);
        $sql->bindParam(":cod_gen", $datos['cod_gen']);
        $sql->execute();
        return $sql;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function consultar_persona_modelo(){
        $consultaPersona = mainModel::conectar()->prepare("SELECT a.*, b.*, c.*, TIMESTAMPDIFF(YEAR,a.fec_nac,CURDATE()) AS edad FROM dat_per AS a INNER JOIN tab_gen AS b ON a.cod_gen=b.cod_gen INNER JOIN tab_nac AS c ON a.cod_nac=c.cod_nac");
        $consultaPersona->execute();
        $row = $consultaPersona->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function validar_cedula_modelo($ced){
        $validarCedula = mainModel::conectar()->prepare("SELECT * FROM dat_per WHERE ced='$ced'");
        $validarCedula->execute();
        return $validarCedula;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function editar_persona_modelo($datos){
       $editarPersona = mainModel::conectar()->prepare("UPDATE dat_per SET cod_nac=:cod_nac, ced=:ced, nom=:nom, ape=:ape, fec_nac=:fec_nac, cod_gen=:cod_gen WHERE cod_per=:cod_per");
       $editarPersona->bindParam(":cod_per", $datos['cod_per']);
       $editarPersona->bindParam(":cod_nac", $datos['cod_nac']);
       $editarPersona->bindParam(":ced", $datos['ced']);
       $editarPersona->bindParam(":nom", $datos['nom']);
       $editarPersona->bindParam(":ape", $datos['ape']);
       $editarPersona->bindParam(":fec_nac", $datos['fec_nac']);
       $editarPersona->bindParam(":cod_gen", $datos['cod_gen']);
       $editarPersona->execute();
       return $editarPersona;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function eliminar_persona_modelo($datos){
        $eliminarPersona = mainModel::conectar()->prepare("DELETE FROM dat_per WHERE cod_per=:cod_per");
        $eliminarPersona->bindParam(":cod_per", $datos['cod_per']);
        $eliminarPersona->execute();
        return $eliminarPersona;
    }

}
