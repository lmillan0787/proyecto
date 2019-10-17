<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class usuarioModelo extends mainModel
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function agregar_usuario_modelo($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO dat_usr(cod_per,des_usr,clave,cod_perf) VALUES (:cod_per,:des_usr,:clave,:cod_perf)");
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->bindParam(":des_usr", $datos['des_usr']);
        $sql->bindParam(":clave", $datos['clave']);
        $sql->bindParam(":cod_perf", $datos['cod_perf']);        
        $sql->execute();
        return $sql;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function consultar_usuario_modelo(){
        $consultaUsuario = mainModel::conectar()->prepare("SELECT a.*,b.*,c.* FROM dat_usr AS a INNER JOIN dat_per AS b ON a.cod_per=b.cod_per INNER JOIN tab_perf AS c ON c.cod_perf=a.cod_perf");
        $consultaUsuario->execute();
        $row = $consultaUsuario->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function consultar_usuario_nombre($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM dat_usr WHERE des_usr=:des_usr");
        $sql->bindParam(":des_usr", $datos['des_usr']);
        $sql->execute();        
        return $sql;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function validar_cedula($ced){
        $validarCedula = mainModel::conectar()->prepare("SELECT * FROM dat_per WHERE ced='$ced'");
        $validarCedula->execute();
        return $validarCedula;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function editar_usuario_modelo($datos){
       $editarUsuario = mainModel::conectar()->prepare("UPDATE dat_per SET cod_nac=:cod_nac, ced=:ced, nom=:nom, ape=:ape, fec_nac=:fec_nac, cod_gen=:cod_gen WHERE cod_per=:cod_per");
       $editarUsuario->bindParam(":cod_per", $datos['cod_per']);
       $editarUsuario->bindParam(":cod_nac", $datos['cod_nac']);
       $editarUsuario->bindParam(":ced", $datos['ced']);
       $editarUsuario->bindParam(":nom", $datos['nom']);
       $editarUsuario->bindParam(":ape", $datos['ape']);
       $editarUsuario->bindParam(":fec_nac", $datos['fec_nac']);
       $editarUsuario->bindParam(":cod_gen", $datos['cod_gen']);
       $editarUsuario->execute();
       return $editarUsuario;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function eliminar_usuario_modelo($datos){
        $eliminarUsuario = mainModel::conectar()->prepare("DELETE FROM dat_per WHERE cod_per=:cod_per");
        $eliminarUsuario->bindParam(":cod_per", $datos['cod_per']);
        $eliminarUsuario->execute();
        return $eliminarUsuario;
    }
    

}
