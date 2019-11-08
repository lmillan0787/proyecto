<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class participacionModelo extends mainModel
{
    protected function agregar_participacion($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO dat_par(cod_per,cod_even,cod_perf) VALUES (:cod_per,:cod_even,:cod_perf)");
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->bindParam(":cod_perf", $datos['cod_perf']);        
        $sql->execute();
        return $sql;
    }
    public function consultar_participacion_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT *, TIMESTAMPDIFF(YEAR,a.fec_nac,CURDATE()) AS edad FROM dat_per a, dat_par b, tab_gen c, tab_perf d, dat_even e where a.cod_gen=c.cod_gen and b.cod_perf=d.cod_perf and a.cod_per=b.cod_per and b.cod_even=e.cod_even and b.cod_even=:cod_even");
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    public function eliminar_participacion_modelo($datos){
        $eliminar = mainModel::conectar()->prepare("DELETE FROM dat_par WHERE cod_par=:cod_par");
        $eliminar->bindParam(":cod_par", $datos['cod_par']);
        $eliminar->execute();
        return $eliminar;

    }
    protected function editar_participacion($datos){
        $editarParticipacion = mainModel::conectar()->prepare("UPDATE dat_par SET (nac=:nac, ced=:ced, nom=:nom, ape=:ape, fec_nac=:fec_nac, cod_gen=cod_gen) WHERE cod_per=:cod_per");
       $editarParticipacion->bindParam(":cod_nac", $datos['cod_nac']);
       $editarParticipacion->bindParam(":ced", $datos['ced']);
       $editarParticipacion->bindParam(":nom", $datos['nom']);
       $editarParticipacion->bindParam(":ape", $datos['ape']);
       $editarParticipacion->bindParam(":fec_nac", $datos['fec_nac']);
       $editarParticipacion->bindParam(":cod_gen", $datos['cod_gen']);
       $editarParticipacion->execute();
       return $editarParticipacion;
    }
    /*public function consultar_participacion(){
        $consultaParticipacion = mainModel::conectar()->prepare("SELECT *, TIMESTAMPDIFF(YEAR,a.fec_nac,CURDATE()) AS edad FROM dat_per a, dat_par b, tab_gen c, tab_perf d, dat_even e where a.cod_gen=c.cod_gen and b.cod_perf=d.cod_perf and a.cod_per=b.cod_per and b.cod_even=e.cod_even");
        $consultaParticipacion->execute();
        $row = $consultaParticipacion->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }*/

}
