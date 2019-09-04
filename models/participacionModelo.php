<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class participacionModelo extends mainModel
{
    protected function agregar_participacion($datos){
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
    public function consultar_participacion(){
        $consultaParticipacion = mainModel::conectar()->prepare("select *, TIMESTAMPDIFF(YEAR,a.fec_nac,CURDATE()) AS edad from dat_per a, dat_par b, tab_gen c, tab_perf d, dat_even e where a.cod_gen=c.cod_gen and b.cod_perf=d.cod_perf and a.cod_per=b.cod_per and b.cod_even=e.cod_even");
        $consultaParticipacion->execute();
        $row = $consultaParticipacion->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    public function validar_cedula($ced){
        $validarCedula = mainModel::conectar()->prepare("SELECT * FROM dat_per WHERE ced='$ced'");
        $validarCedula->execute();
        return $validarCedula;

    }
    protected function editar_participacion($datos){
        $editarParticipacion = mainModel::conectar()->prepare("UPDATE dat_per SET (nac=:nac, ced=:ced, nom=:nom, ape=:ape, fec_nac=:fec_nac, cod_gen=cod_gen) WHERE cod_per=:cod_per");
       $editarParticipacion->bindParam(":nac", $datos['nac']);
       $editarParticipacion->bindParam(":ced", $datos['ced']);
       $editarParticipacion->bindParam(":nom", $datos['nom']);
       $editarParticipacion->bindParam(":ape", $datos['ape']);
       $editarParticipacion->bindParam(":fec_nac", $datos['fec_nac']);
       $editarParticipacion->bindParam(":cod_gen", $datos['cod_gen']);
       $editarParticipacion->execute();
       return $editarParticipacion;
    }

}
