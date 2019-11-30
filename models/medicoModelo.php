<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class medicoModelo extends mainModel
{
    protected function agregar_medico($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO dat_par (cod_per,cod_even,cod_perf,cod_estat) VALUES (:cod_per,:cod_even,:cod_perf,1);
        INSERT INTO dat_del (cod_par,cod_reg,cod_pue,cod_dis,cod_cat) VALUES (LAST_insert_id(),:cod_reg,:cod_pue,:cod_dis,:cod_cat)");
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->bindParam(":cod_perf", $datos['cod_perf']);
        $sql->bindParam(":cod_reg", $datos['cod_reg']);
        $sql->bindParam(":cod_pue", $datos['cod_pue']);
        $sql->bindParam(":cod_dis", $datos['cod_dis']);
        $sql->bindParam(":cod_cat", $datos['cod_cat']);
        $sql->execute();
        return $sql;
    }
    protected function consultar_medico(){
        $consultaMedico = mainModel::conectar()->prepare("SELECT a.*, b.*, c.*,d.* ,e.*,f.*,g.*,h.*, TIMESTAMPDIFF(YEAR,a.fec_nac,CURDATE()) AS edad FROM dat_per AS a INNER JOIN dat_par AS b ON b.cod_per=a.cod_per INNER JOIN dat_del AS c ON b.cod_par=c.cod_par INNER JOIN tab_gen as d ON a.cod_gen=d.cod_gen INNER JOIN tab_reg AS e ON c.cod_reg=e.cod_reg INNER JOIN tab_pue as f on c.cod_pue=f.cod_pue INNER JOIN dat_even AS g ON b.cod_even=g.cod_even INNER JOIN tab_estat AS h ON b.cod_estat=h.cod_estat WHERE cod_perf=6 AND a.cod_estat=1 ORDER BY c.cod_par DESC");
        $consultaMedico->execute();
        $row = $consultaMedico->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    protected function validar_cedula($ced){
        $validarCedula = mainModel::conectar()->prepare("SELECT * FROM dat_per WHERE ced='$ced'");
        $validarCedula->execute();
        return $validarCedula;

    }
    protected function editar_medico_modelo($datos){
        $sql = mainModel::conectar()->prepare("UPDATE dat_par AS a INNER JOIN dat_del b ON a.cod_par=b.cod_par SET cod_per=:cod_per,cod_even=:cod_even,cod_estat=:cod_estat,cod_reg=:cod_reg,cod_pue=:cod_pue,cod_dis=:cod_dis,cod_cat=:cod_cat,foto=:foto WHERE a.cod_par=:cod_par");
        $sql->bindParam(":cod_par", $datos['cod_par']);
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->bindParam(":cod_estat", $datos['cod_estat']);
        $sql->bindParam(":cod_reg", $datos['cod_reg']);
        $sql->bindParam(":cod_pue", $datos['cod_pue']);
        $sql->bindParam(":cod_dis", $datos['cod_dis']);
        $sql->bindParam(":cod_cat", $datos['cod_cat']);
        $sql->bindParam(":foto", $datos['foto']);  
        $sql->execute();
        return $sql;
    }

  

}
