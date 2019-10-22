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
    public function consultar_persona_modelo2($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM dat_per WHERE ced=:ced");
        $sql->bindParam(":ced", $datos['ced']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }   
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function editar_persona_modelo($datos){
       $sql = mainModel::conectar()->prepare("UPDATE dat_per SET cod_nac=:cod_nac, ced=:ced, nom=:nom, ape=:ape, fec_nac=:fec_nac, cod_gen=:cod_gen WHERE cod_per=:cod_per");
       $sql->bindParam(":cod_per", $datos['cod_per']);
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
    protected function eliminar_persona_modelo($datos){
        $eliminarPersona = mainModel::conectar()->prepare("DELETE FROM dat_per WHERE cod_per=:cod_per");
        $eliminarPersona->bindParam(":cod_per", $datos['cod_per']);
        $eliminarPersona->execute();
        return $eliminarPersona;
    }

}
