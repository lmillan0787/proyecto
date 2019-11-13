<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}
class disciplinaModelo extends mainModel
{
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //cargar tabla de evento
    protected function agregar_disciplina($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO tab_dis(des_dis,cod_tip_even) VALUES (:des_dis,:cod_tip_even)");
        $sql->bindParam(":des_dis", $datos['des_dis']);
        $sql->bindParam(":cod_tip_even", $datos['cod_tip_even']);
        
        $sql->execute();
        return $sql;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //cargar tabla de evento
    protected function consultar_disciplina()
    {
        $consultaDisciplina = mainModel::conectar()->prepare("SELECT a.*, b.* FROM tab_dis AS a INNER JOIN tab_tip_even AS b ON a.cod_tip_even=b.cod_tip_even ORDER BY des_dis ASC");
        $consultaDisciplina->execute();
        $row = $consultaDisciplina->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar disciplinas autoctonas
    protected function consultar_disciplinas_autoctonas_modelo()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_dis WHERE cod_tip_even=1 ORDER BY des_dis ASC");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar disciplinas convencionales
    protected function consultar_disciplinas_convencionales_modelo()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_dis WHERE cod_tip_even=2 ORDER BY des_dis ASC");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar disciplinas autoctonas
    protected function consultar_disciplinas_modelo()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_dis ORDER BY des_dis ASC");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
}
