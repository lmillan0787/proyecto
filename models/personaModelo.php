<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class personaModelo extends mainModel
{
    protected function agregar_persona($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO dat_per(nac,ced,nom,ape,fec_nac,cod_gen) VALUES (:nac,:ced,:nom,:ape,:fec_nac,:cod_gen)");
        $sql->bindParam(":nac", $datos['nac']);
        $sql->bindParam(":ced", $datos['ced']);
        $sql->bindParam(":nom", $datos['nom']);
        $sql->bindParam(":ape", $datos['ape']);
        $sql->bindParam(":fec_nac", $datos['fec_nac']);
        $sql->bindParam(":cod_gen", $datos['cod_gen']);
        $sql->execute();
        return $sql;
    }
    public function consultar_persona(){
        $consultaPersona = mainModel::conectar()->prepare("SELECT a.*, b.*,TIMESTAMPDIFF(YEAR,a.fec_nac,CURDATE()) AS edad FROM dat_per AS a INNER JOIN tab_gen AS b ON a.cod_gen=b.cod_gen");
        $consultaPersona->execute();
        $row = $consultaPersona->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    public function validar_cedula($ced){
        $validarCedula = mainModel::conectar()->prepare("SELECT * FROM dat_per WHERE ced='$ced'");
        $validarCedula->execute();
        return $validarCedula;

    }
    protected function editar_persona($datos){
        $editarPersona = mainModel::conectar()->prepare("UPDATE dat_per SET (nac=:nac, ced=:ced, nom=:nom, ape=:ape, fec_nac=:fec_nac, cod_gen=cod_gen) WHERE cod_per=:cod_per");
       $editarPersona->bindParam(":nac", $datos['nac']);
       $editarPersona->bindParam(":ced", $datos['ced']);
       $editarPersona->bindParam(":nom", $datos['nom']);
       $editarPersona->bindParam(":ape", $datos['ape']);
       $editarPersona->bindParam(":fec_nac", $datos['fec_nac']);
       $editarPersona->bindParam(":cod_gen", $datos['cod_gen']);
       $editarPersona->execute();
       return $editarPersona;
    }

}
