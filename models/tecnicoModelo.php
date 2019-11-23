<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class tecnicoModelo extends mainModel
{
    protected function agregar_tecnico($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO dat_par (cod_per,cod_even,cod_perf,cod_estat) VALUES (:cod_per,:cod_even,:cod_perf,1);
        INSERT INTO dat_per_tec (cod_par,cod_inst,cod_carg) VALUES (LAST_insert_id(),:cod_inst,:cod_carg)");
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->bindParam(":cod_perf", $datos['cod_perf']);
        $sql->bindParam(":cod_inst", $datos['cod_inst']);
        $sql->bindParam(":cod_carg", $datos['cod_carg']);
        $sql->execute();
        return $sql;
    }
    protected function consultar_tecnico()
    {
        $consultaTecnico = mainModel::conectar()->prepare("SELECT a.*, b.*, c.*, d.*, e.*, f.*, g.*, h.* FROM dat_per_tec AS a INNER JOIN dat_par AS b ON a.cod_par=b.cod_par INNER JOIN dat_per AS c on c.cod_per=b.cod_per INNER JOIN dat_even AS d ON d.cod_even=b.cod_even INNER JOIN tab_inst AS e ON e.cod_inst=a.cod_inst INNER JOIN tab_carg AS f ON f.cod_carg=a.cod_carg INNER JOIN tab_perf AS g ON g.cod_perf=b.cod_perf INNER JOIN tab_estat AS h ON h.cod_estat=b.cod_estat WHERE c.cod_estat=1");
        $consultaTecnico->execute();
        $row = $consultaTecnico->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    protected function consultar_tecnico_especifico()
    {
        $consultaTecnico = mainModel::conectar()->prepare("SELECT a.*, b.*, c.*, d.*, e.*, f.*, g.*, h.* FROM dat_per_tec AS a INNER JOIN dat_par AS b ON a.cod_par=b.cod_par INNER JOIN dat_per AS c on c.cod_per=b.cod_per INNER JOIN dat_even AS d ON d.cod_even=b.cod_even INNER JOIN tab_inst AS e ON e.cod_inst=a.cod_inst INNER JOIN tab_carg AS f ON f.cod_carg=a.cod_carg INNER JOIN tab_perf AS g ON g.cod_perf=b.cod_perf INNER JOIN tab_estat AS h ON h.cod_estat=b.cod_estat WHERE b.cod_per=:cod_per");
        $consultaTecnico->execute();
        $row = $consultaTecnico->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    protected function validar_cedula($ced)
    {
        $validarCedula = mainModel::conectar()->prepare("SELECT * FROM dat_per WHERE ced='$ced'");
        $validarCedula->execute();
        return $validarCedula;
    }
    protected function editar_tecnico_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("UPDATE dat_par AS a INNER JOIN dat_per_tec AS b ON a.cod_par=b.cod_par SET a.cod_per=:cod_per,a.cod_even=:cod_even,a.cod_perf=:cod_perf,a.cod_estat=:cod_estat,b.cod_inst=:cod_inst,b.cod_carg=:cod_carg WHERE a.cod_par=:cod_par");
        $sql->bindParam(":cod_par", $datos['cod_par']);
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->bindParam(":cod_perf", $datos['cod_perf']);
        $sql->bindParam(":cod_estat", $datos['cod_estat']);
        $sql->bindParam(":cod_inst", $datos['cod_inst']);
        $sql->bindParam(":cod_carg", $datos['cod_carg']);
        $sql->execute();
        return $sql;
    }
    protected function consultaCargo()
    {
        $consultaCargo = mainModel::conectar()->prepare("SELECT * FROM tab_carg");
        $consultaCargo->execute();
        $row = $consultaCargo->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    protected function consultaInstitucion()
    {
        $consultaInstitucion = mainModel::conectar()->prepare("SELECT * FROM tab_inst");
        $consultaInstitucion->execute();
        $row = $consultaInstitucion->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
}
