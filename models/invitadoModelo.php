<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class invitadoModelo extends mainModel
{
    protected function agregar_invitado($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO dat_per(nac,ced,nom,ape,fec_nac,cod_gen,cod_per,cod_even,cod_perf) VALUES (:nac,:ced,:nom,:ape,:fec_nac,:cod_gen,:cod_per,:cod_even,:cod_perf)");
        $sql->bindParam(":nac", $datos['nac']);
        $sql->bindParam(":ced", $datos['ced']);
        $sql->bindParam(":nom", $datos['nom']);
        $sql->bindParam(":ape", $datos['ape']);
        $sql->bindParam(":fec_nac", $datos['fec_nac']);
        $sql->bindParam(":cod_gen", $datos['cod_gen']);
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->bindParam(":cod_perf", $datos['cod_perf']);
        
        $sql->execute();
        return $sql;
}
    public function consultar_invitado(){
        $consultaInvitado = mainModel::conectar()->prepare("SELECT a.*, b.*,c.*, TIMESTAMPDIFF(YEAR,a.fec_nac,CURDATE()) AS edad FROM dat_per AS a INNER JOIN dat_par AS b ON b.cod_per=a.cod_per INNER JOIN tab_gen AS c ON a.cod_gen=c.cod_gen where cod_perf=14");
        $consultaInvitado->execute();
        $row = $consultaInvitado->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    public function validar_cedula($ced){
        $validarCedula = mainModel::conectar()->prepare("SELECT * FROM dat_per WHERE ced='$ced'");
        $validarCedula->execute();
        return $validarCedula;

    }
    protected function editar_invitado($datos){
        $editarInvitado = mainModel::conectar()->prepare("UPDATE dat_per SET (nac=:nac, ced=:ced, nom=:nom, ape=:ape, fec_nac=:fec_nac, cod_gen=cod_gen) WHERE cod_per=:cod_per");
       $editarInvitado->bindParam(":nac", $datos['nac']);
       $editarInvitado->bindParam(":ced", $datos['ced']);
       $editarInvitado->bindParam(":nom", $datos['nom']);
       $editarInvitado->bindParam(":ape", $datos['ape']);
       $editarInvitado->bindParam(":fec_nac", $datos['fec_nac']);
       $editarInvitado->bindParam(":cod_gen", $datos['cod_gen']);
       $editarInvitado->execute();
       return $editarInvitado;
    }

  

}
