<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class credencialModelo extends mainModel
{
    public function consultar_participacion_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT *, TIMESTAMPDIFF(YEAR,a.fec_nac,CURDATE()) AS edad FROM dat_per a, dat_par b, tab_gen c, tab_perf d, dat_even e where a.cod_gen=c.cod_gen and b.cod_perf=d.cod_perf and a.cod_per=b.cod_per and b.cod_even=e.cod_even and b.cod_even=:cod_even");
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

}
