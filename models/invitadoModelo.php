<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class invitadoModelo extends mainModel
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function consultar_invitado_modelo(){
        $sql = mainModel::conectar()->prepare("SELECT a.*, b.*,c.*,d.*,f.*,g.*, TIMESTAMPDIFF(YEAR,a.fec_nac,CURDATE()) AS edad FROM dat_per AS a INNER JOIN dat_par AS b ON b.cod_per=a.cod_per INNER JOIN tab_gen AS c ON a.cod_gen=c.cod_gen INNER JOIN tab_perf AS d ON b.cod_perf=d.cod_perf INNER JOIN dat_even as f ON b.cod_even=f.cod_even INNER JOIN tab_estat AS g ON b.cod_estat=g.cod_estat WHERE b.cod_perf BETWEEN 14 AND 15 AND a.cod_estat=1 ORDER BY cod_par DESC");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function agregar_invitado($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO dat_par (cod_per,cod_even,cod_perf,cod_estat) VALUES (:cod_per,:cod_even,:cod_perf,1)");
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->bindParam(":cod_perf", $datos['cod_perf']);    
        $sql->execute();
        return $sql;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function validar_cedula($ced){
        $sql = mainModel::conectar()->prepare("SELECT * FROM dat_per WHERE ced='$ced'");
        $sql->execute();
        return $sql;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function editar_invitado_modelo($datos){
        $sql = mainModel::conectar()->prepare("UPDATE dat_par SET cod_per=:cod_per, cod_even=:cod_even, cod_perf=:cod_perf, cod_estat=:cod_estat WHERE cod_par=:cod_par");
        $sql->bindParam(":cod_par", $datos['cod_par']);
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->bindParam(":cod_perf", $datos['cod_perf']);
        $sql->bindParam(":cod_estat", $datos['cod_estat']);
        $sql->execute();
        return $sql;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
}
