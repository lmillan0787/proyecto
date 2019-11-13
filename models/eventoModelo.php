<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class eventoModelo extends mainModel
{
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function agregar_evento_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO dat_even(des_even,fec_even,cod_reg,cod_tip_even,cod_estat) VALUES (:des_even,:fec_even,:cod_reg,:cod_tip_even,'1')");
        $sql->bindParam(":des_even", $datos['des_even']);
        $sql->bindParam(":fec_even", $datos['fec_even']);
        $sql->bindParam(":cod_reg", $datos['cod_reg']);
        $sql->bindParam(":cod_tip_even", $datos['cod_tip_even']);        
        $sql->execute();
        return $sql;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function validar_evento_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM dat_even WHERE des_even=:des_even");
        $sql->bindParam(":des_even", $datos['des_even']);
        $sql->execute();
        return $sql;
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function validar_evento_distinto_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT *  FROM dat_even WHERE cod_even!=:cod_even AND des_even=:des_even");
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->bindParam(":des_even", $datos['des_even']);
        $sql->execute();
        return $sql;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function consultar_tabla_evento_modelo()
    {
        $sql = mainModel::conectar()->prepare("SELECT a.*, b.*, c.*, d.* FROM dat_even AS a INNER JOIN tab_reg AS b ON a.cod_reg=b.cod_reg INNER JOIN tab_estat AS c ON      a.cod_estat=c.cod_estat INNER JOIN tab_tip_even AS d ON a.cod_tip_even=d.cod_tip_even ORDER BY a.cod_even DESC ");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function consultar_editar_evento_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT a.*, b.*, c.*, d.* FROM dat_even AS a INNER JOIN tab_reg AS b ON a.cod_reg=b.cod_reg INNER JOIN tab_estat AS c ON      a.cod_estat=c.cod_estat INNER JOIN tab_tip_even AS d ON a.cod_tip_even=d.cod_tip_even WHERE cod_even=:cod_even ");
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function consultar_region_disponible_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM dat_even WHERE cod_estat=:cod_estat AND cod_reg=:cod_reg AND cod_even!=:cod_even");
        $sql->bindParam(":cod_estat", $datos['cod_estat']);
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->bindParam(":cod_reg", $datos['cod_reg']);
        $sql->execute();
        return $sql;
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function eliminar_evento_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("DELETE FROM dat_even WHERE cod_even=:cod_even");
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->execute();
        return $sql;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function editar_evento_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("UPDATE dat_even SET des_even=:des_even, fec_even=:fec_even, cod_reg=:cod_reg, cod_tip_even=:cod_tip_even,cod_estat=:cod_estat WHERE cod_even=:cod_even");
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->bindParam(":des_even", $datos['des_even']);
        $sql->bindParam(":fec_even", $datos['fec_even']);
        $sql->bindParam(":cod_reg", $datos['cod_reg']);
        $sql->bindParam(":cod_tip_even", $datos['cod_tip_even']);
        $sql->bindParam(":cod_estat", $datos['cod_estat']);     
        $sql->execute();
        return $sql;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function validar_region_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM dat_even WHERE cod_reg=:cod_reg AND cod_estat=1");
        $sql->bindParam(":cod_reg", $datos['cod_reg']);
        $sql->execute();
        return $sql;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function consultar_evento_activo_modelo()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM  dat_even WHERE cod_estat=1");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function consultar_tipo_evento_modelo()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_tip_even");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function consultar_tipo_evento_modelo_no_mix()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_tip_even WHERE cod_tip_even!=3");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function consultar_tipo_evento_distinto_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_tip_even WHERE cod_tip_even!=:cod_tip_even");
        $sql->bindParam(":cod_tip_even", $datos['cod_tip_even']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function validar_participacion_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM dat_par WHERE cod_per=:cod_per AND cod_even=:cod_even");
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->execute();
        return $sql;
    }

    
}
