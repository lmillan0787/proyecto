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
        $sql = mainModel::conectar()->prepare("INSERT INTO dat_per(cod_nac,ced,nom,ape,fec_nac,cod_gen) VALUES (:cod_nac,:ced,:nom,:ape,:fec_nac,:cod_gen)");
        $sql->bindParam(":cod_nac", $datos['cod_nac']);
        $sql->bindParam(":ced", $datos['ced']);
        $sql->bindParam(":nom", $datos['nom']);
        $sql->bindParam(":ape", $datos['ape']);
        $sql->bindParam(":fec_nac", $datos['fec_nac']);
        $sql->bindParam(":cod_gen", $datos['cod_gen']);
        $sql->execute();
        return $sql;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function consultar_usuario_modelo(){
        $consultaUsuario = mainModel::conectar()->prepare("SELECT a.*, b.*, c.*, TIMESTAMPDIFF(YEAR,a.fec_nac,CURDATE()) AS edad FROM dat_per AS a INNER JOIN tab_gen AS b ON a.cod_gen=b.cod_gen INNER JOIN tab_nac AS c ON a.cod_nac=c.cod_nac");
        $consultaUsuario->execute();
        $row = $consultaUsuario->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function validar_cedula_modelo($ced){
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
