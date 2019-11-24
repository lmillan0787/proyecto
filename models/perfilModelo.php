<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}
class perfilModelo extends mainModel
{
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //cargar tabla de evento
    protected function agregar_perfil($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO tab_perf(des_perf,cod_rol) VALUES (:des_perf,:cod_rol)");
        $sql->bindParam(":des_perf", $datos['des_perf']);
        $sql->bindParam(":cod_rol", $datos['cod_rol']);
        
        $sql->execute();
        return $sql;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //cargar tabla de evento
    protected function consultar_perfil()
    {
        $consultaInstitucion = mainModel::conectar()->prepare("SELECT * FROM tab_perf WHERE cod_rol=4 ORDER BY cod_perf ASC");
        $consultaInstitucion->execute();
        $row = $consultaInstitucion->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar perfils autoctonas
    protected function consultar_perfil_autoctona_modelo()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_perf WHERE cod_rol=1 ORDER BY des_perf ASC");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar perfils convencionales
    protected function consultar_perfil_convencionales_modelo()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_perf WHERE cod_rol=4 ORDER BY des_perf ASC");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar perfils autoctonas
    protected function consultar_perfil_modelo()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_perf WHERE cod_rol=4 ORDER BY `cod_perf` DESC");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar perfils autoctonas
    protected function consultar_perfil_distinta_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_perf WHERE des_perf=:des_perf");
        $sql->bindParam(":des_perf", $datos['des_perf']);
        $sql->execute();
        return $sql;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar perfils autoctonas
    protected function consultar_perfil_editar($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_perf WHERE cod_perf=:cod_perf");
        $sql->bindParam(":cod_perf", $datos['cod_perf']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //cargar tabla de evento
    protected function editar_perfil_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("UPDATE tab_perf SET des_perf=:des_perf, cod_rol=:cod_rol WHERE cod_perf=:cod_perf ");
        $sql->bindParam(":cod_perf", $datos['cod_perf']);
        $sql->bindParam(":des_perf", $datos['des_perf']);
        $sql->bindParam(":cod_rol", $datos['cod_rol']);
        $sql->execute();
        return $sql;
    }
}
