<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class usuarioModelo extends mainModel
{
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function agregar_usuario_modelo($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO dat_usr(cod_per,des_usr,clave,cod_perf,cod_estat) VALUES (:cod_per,:des_usr,:clave,:cod_perf,1)");
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->bindParam(":des_usr", $datos['des_usr']);
        $sql->bindParam(":clave", $datos['clave']);
        $sql->bindParam(":cod_perf", $datos['cod_perf']);        
        $sql->execute();
        return $sql;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function consultar_usuario_modelo(){
        $sql = mainModel::conectar()->prepare("SELECT a.*,b.*,c.*,d.* FROM dat_usr AS a INNER JOIN dat_per AS b ON a.cod_per=b.cod_per INNER JOIN tab_perf AS c ON c.cod_perf=a.cod_perf INNER JOIN tab_estat AS d ON a.cod_estat=d.cod_estat");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function consultar_usuario_nombre($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM dat_usr WHERE des_usr=:des_usr");
        $sql->bindParam(":des_usr", $datos['des_usr']);
        $sql->execute();        
        return $sql;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function consultar_datos_usuario($datos){
        $sql = mainModel::conectar()->prepare("SELECT a.*,b.*,c.*,d.* FROM dat_usr AS a INNER JOIN dat_per AS b ON a.cod_per=b.cod_per INNER JOIN tab_estat AS c ON a.cod_estat=c.cod_estat INNER JOIN tab_perf AS d ON a.cod_perf=d.cod_perf WHERE cod_usr=:cod_usr");
        $sql->bindParam(":cod_usr", $datos['cod_usr']);
        $sql->execute();        
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function consular_usuario_disponible_modelo($cod_per){
        $sql = mainModel::conectar()->prepare("SELECT * FROM dat_usr WHERE cod_per=:cod_per");
        $sql->bindParam(":cod_per", $cod_per);
        $sql->execute();
        return $sql;
    }
    /////////////////////////////////////////////sql///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function formulario_usuario_perfil_modelo(){
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_perf WHERE cod_rol='1' AND cod_perf!='3'");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////sql///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function formulario_editar_perfil_distinto_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_perf WHERE cod_rol='1' AND cod_perf!='3' AND cod_perf!=:cod_perf");
        $sql->bindParam(":cod_perf", $datos['cod_perf']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////sql///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function formulario_editar_estatus_distinto_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_estat WHERE cod_estat!=:cod_estat");
        $sql->bindParam(":cod_estat", $datos['cod_estat']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function editar_usuario_modelo($datos){
       $sql = mainModel::conectar()->prepare("UPDATE dat_usr SET des_usr=:des_usr, clave=:clave, cod_perf=:cod_perf, cod_estat=:cod_estat WHERE cod_usr=:cod_usr");
       $sql->bindParam(":des_usr", $datos['des_usr']);
       $sql->bindParam(":clave", $datos['clave']);
       $sql->bindParam(":cod_perf", $datos['cod_perf']);
       $sql->bindParam(":cod_estat", $datos['cod_estat']);
       $sql->bindParam(":cod_usr", $datos['cod_usr']);
       $sql->execute();
       return $sql;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function validar_usuario_distinto_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM dat_usr WHERE des_usr=:des_usr AND cod_usr!=:cod_usr");
        $sql->bindParam(":des_usr", $datos['des_usr']);
        $sql->bindParam(":cod_usr", $datos['cod_usr']);
        $sql->execute();
        return $sql;
     }
}
