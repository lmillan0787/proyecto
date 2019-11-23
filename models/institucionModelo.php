<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}
class institucionModelo extends mainModel
{
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //cargar tabla de evento
    protected function agregar_institucion($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO tab_inst(des_inst,siglas) VALUES (:des_inst,:siglas)");
        $sql->bindParam(":des_inst", $datos['des_inst']);
        $sql->bindParam(":siglas", $datos['siglas']);
        
        $sql->execute();
        return $sql;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //cargar tabla de evento
    protected function consultar_institucion()
    {
        $consultaInstitucion = mainModel::conectar()->prepare("SELECT * FROM tab_inst ORDER BY cod_inst ASC");
        $consultaInstitucion->execute();
        $row = $consultaInstitucion->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar institucions autoctonas
    protected function consultar_institucions_autoctonas_modelo()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_inst WHERE siglas=1 ORDER BY des_inst ASC");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar institucions convencionales
    protected function consultar_institucion_convencionales_modelo()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_inst WHERE siglas=2 ORDER BY des_inst ASC");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar institucions autoctonas
    protected function consultar_institucion_modelo()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM `tab_inst` ORDER BY `cod_inst` DESC");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar institucions autoctonas
    protected function consultar_institucion_distinta_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_inst WHERE des_inst=:des_inst");
        $sql->bindParam(":des_inst", $datos['des_inst']);
        $sql->execute();
        return $sql;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar institucions autoctonas
    protected function consultar_institucion_editar($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_inst WHERE cod_inst=:cod_inst");
        $sql->bindParam(":cod_inst", $datos['cod_inst']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //cargar tabla de evento
    protected function editar_institucion_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("UPDATE tab_inst SET des_inst=:des_inst, siglas=:siglas WHERE cod_inst=:cod_inst ");
        $sql->bindParam(":cod_inst", $datos['cod_inst']);
        $sql->bindParam(":des_inst", $datos['des_inst']);
        $sql->bindParam(":siglas", $datos['siglas']);
        $sql->execute();
        return $sql;
    }
}
