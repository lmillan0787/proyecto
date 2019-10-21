<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class eventoModelo extends mainModel
{
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function agregar_evento_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO dat_even(des_even,fec_even,cod_edo,cod_tip_even,cod_estat) VALUES (:des_even,:fec_even,:cod_edo,:cod_tip_even,'1')");
        $sql->bindParam(":des_even", $datos['des_even']);
        $sql->bindParam(":fec_even", $datos['fec_even']);
        $sql->bindParam(":cod_edo", $datos['cod_edo']);
        $sql->bindParam(":cod_tip_even", $datos['cod_tip_even']);        
        $sql->execute();
        return $sql;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function validar_evento_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM dat_even WHERE des_even=:des_even");
        $sql->bindParam(":des_even", $datos['des_even']);
        $sql->execute();
        return $sql;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function consultar_evento_modelo()
    {
        $sql = mainModel::conectar()->prepare("SELECT a.*, b.*, c.*, d.* FROM dat_even AS a INNER JOIN tab_edo AS b ON a.cod_edo=b.cod_edo INNER JOIN tab_estat AS c ON      a.cod_estat=c.cod_estat INNER JOIN tab_tip_even AS d ON a.cod_tip_even=d.cod_tip_even ORDER BY cod_even DESC ");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function eliminar_evento($datos)
    {
        $sql = mainModel::conectar()->prepare("DELETE FROM dat_even WHERE cod_even=:cod_even");
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->execute();
        return $sql;
    }
}
