<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class participacionModelo extends mainModel
{
    protected function lista_participacion_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT a.*, b.*, c.*, d.*, a.cod_estat AS part, e.* FROM dat_par AS a INNER JOIN dat_per AS b ON a.cod_per=b.cod_per INNER JOIN dat_even AS c ON a.cod_even=c.cod_even INNER JOIN tab_perf AS d ON a.cod_perf=d.cod_perf INNER JOIN tab_estat AS e ON a.cod_estat=e.cod_estat WHERE a.cod_even=:cod_even AND b.cod_estat=1 ORDER BY a.cod_par DESC");
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    protected function agregar_participacion($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO dat_par(cod_per,cod_even,cod_perf) VALUES (:cod_per,:cod_even,:cod_perf)");
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->bindParam(":cod_perf", $datos['cod_perf']);        
        $sql->execute();
        return $sql;
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
    protected function lista_participacion_delegaciones_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT a.*, b.*, c.*, d.*, e.*, f.*, g.*, h.*, i.* FROM dat_par AS a INNER JOIN dat_per AS b ON a.cod_per=b.cod_per INNER JOIN dat_even AS c ON a.cod_even=c.cod_even INNER JOIN tab_perf AS d ON a.cod_perf=d.cod_perf INNER JOIN tab_estat AS e ON a.cod_estat=e.cod_estat INNER JOIN dat_del AS f ON a.cod_par=f.cod_par INNER JOIN tab_reg AS g ON f.cod_reg=g.cod_reg INNER JOIN tab_pue AS h ON f.cod_pue=h.cod_pue INNER JOIN tab_dis AS i ON f.cod_dis=i.cod_dis WHERE a.cod_par=:cod_par AND b.cod_estat=1 ORDER BY a.cod_par DESC");
        $sql->bindParam(":cod_par", $datos['cod_par']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    protected function lista_participacion_tecnicos_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT a.*, b.*, c.*, d.*, e.*, f.*, g.*, h.* FROM dat_par AS a INNER JOIN dat_per AS b ON a.cod_per=b.cod_per INNER JOIN dat_even AS c ON a.cod_even=c.cod_even INNER JOIN tab_perf AS d ON a.cod_perf=d.cod_perf INNER JOIN tab_estat AS e ON a.cod_estat=e.cod_estat INNER JOIN dat_per_tec AS f ON a.cod_par=f.cod_par INNER JOIN tab_inst AS g ON f.cod_inst=g.cod_inst INNER JOIN tab_carg AS h ON f.cod_carg=h.cod_carg WHERE a.cod_par=:cod_par AND b.cod_estat=1 ORDER BY a.cod_par DESC");
        $sql->bindParam(":cod_par", $datos['cod_par']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

}
