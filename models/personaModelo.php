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
        $sql = mainModel::conectar()->prepare("INSERT INTO dat_per(ced,nom,ape,fec_nac,cod_gen,cod_estat) VALUES (:ced,:nom,:ape,:fec_nac,:cod_gen,1)");
        $sql->bindParam(":ced", $datos['ced']);
        $sql->bindParam(":nom", $datos['nom']);
        $sql->bindParam(":ape", $datos['ape']);
        $sql->bindParam(":fec_nac", $datos['fec_nac']);
        $sql->bindParam(":cod_gen", $datos['cod_gen']);
        $sql->execute();
        return $sql;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function consultar_persona_modelo1($datos){
        $sql = mainModel::conectar()->prepare("SELECT a.*, b.*, c.* FROM dat_per AS a INNER JOIN tab_gen AS b on a.cod_gen=b.cod_gen INNER JOIN tab_estat AS c ON a.cod_estat=c.cod_estat WHERE cod_per=:cod_per");
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }   
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function consultar_persona_modelo2($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM dat_per WHERE ced=:ced  ORDER BY cod_per DESC");
        $sql->bindParam(":ced", $datos['ced']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function editar_persona_modelo($datos){
       $sql = mainModel::conectar()->prepare("UPDATE dat_per SET ced=:ced, nom=:nom, ape=:ape, fec_nac=:fec_nac, cod_gen=:cod_gen, cod_estat=:cod_estat WHERE cod_per=:cod_per");
       $sql->bindParam(":cod_per", $datos['cod_per']);
       $sql->bindParam(":ced", $datos['ced']);
       $sql->bindParam(":nom", $datos['nom']);
       $sql->bindParam(":ape", $datos['ape']);
       $sql->bindParam(":fec_nac", $datos['fec_nac']);
       $sql->bindParam(":cod_gen", $datos['cod_gen']);
       $sql->bindParam(":cod_estat", $datos['cod_estat']);
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function validar_persona_distinta_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM dat_per WHERE cod_per!=:cod_per AND ced=:ced");
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->bindParam(":ced", $datos['ced']);
        $sql->execute();
        return $sql;
    }

}
