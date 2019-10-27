<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class invitadoModelo extends mainModel
{
    protected function agregar_invitado($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO dat_par (cod_per,cod_even,cod_perf) VALUES (:cod_per,:cod_even,:cod_perf)");
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->bindParam(":cod_perf", $datos['cod_perf']);    
        $sql->execute();
        return $sql;
    }
    public function consultar_invitado(){
        $consultaInvitado = mainModel::conectar()->prepare("SELECT a.*, b.*,c.*,d.*,f.*, TIMESTAMPDIFF(YEAR,a.fec_nac,CURDATE()) AS edad FROM dat_per AS a INNER JOIN dat_par AS b ON b.cod_per=a.cod_per INNER JOIN tab_gen AS c ON a.cod_gen=c.cod_gen INNER JOIN tab_perf AS d ON b.cod_perf=d.cod_perf INNER JOIN dat_even as f ON b.cod_even=f.cod_even WHERE b.cod_perf BETWEEN 14 AND 15");
        $consultaInvitado->execute();
        $row = $consultaInvitado->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    public function validar_cedula($ced){
        $validarCedula = mainModel::conectar()->prepare("SELECT * FROM dat_per WHERE ced='$ced'");
        $validarCedula->execute();
        return $validarCedula;

    }
    protected function editar_deportista($datos){
        $editarDeportista = mainModel::conectar()->prepare("UPDATE dat_per SET (nac=:nac, ced=:ced, nom=:nom, ape=:ape, fec_nac=:fec_nac, cod_gen=cod_gen) WHERE cod_per=:cod_per");
       $editarDeportista->bindParam(":nac", $datos['nac']);
       $editarDeportista->bindParam(":ced", $datos['ced']);
       $editarDeportista->bindParam(":nom", $datos['nom']);
       $editarDeportista->bindParam(":ape", $datos['ape']);
       $editarDeportista->bindParam(":fec_nac", $datos['fec_nac']);
       $editarDeportista->bindParam(":cod_gen", $datos['cod_gen']);
       $editarDeportista->execute();
       return $editarDeportista;
    }

  

}
