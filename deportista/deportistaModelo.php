<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class deportistaModelo extends mainModel
{
    protected function agregar_deportista($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO dat_per(nac,ced,nom,ape,fec_nac,cod_gen) VALUES (:nac,:ced,:nom,:ape,:fec_nac,:cod_gen)");
        $sql->bindParam(":nac", $datos['nac']);
        $sql->bindParam(":ced", $datos['ced']);
        $sql->bindParam(":nom", $datos['nom']);
        $sql->bindParam(":ape", $datos['ape']);
        $sql->bindParam(":fec_nac", $datos['fec_nac']);
        $sql->bindParam(":cod_gen", $datos['cod_gen']);
        $sql->execute();
        return $sql;
    }
    public function consultar_deportista(){
        $consultaDeportista = mainModel::conectar()->prepare("SELECT a.*, b.*, c.*,d.* ,e.*, TIMESTAMPDIFF(YEAR,a.fec_nac,CURDATE()) AS edad FROM dat_per AS a INNER JOIN dat_par AS b ON b.cod_per=a.cod_per INNER JOIN dat_del AS c ON b.cod_par=c.cod_par INNER JOIN tab_gen as d  ON a.cod_gen=d.cod_gen INNER JOIN tab_reg as e on c.cod_reg=e.cod_reg  ORDER BY c.cod_par ASC");
        $consultaDeportista->execute();
        $row = $consultaDeportista->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    public function validar_cedula($ced){
        $validarCedula = mainModel::conectar()->prepare("SELECT * FROM dat_per WHERE ced='$ced'");
        $validarCedula->execute();
        return $validarCedula;

    }
    protected function editar_deportista($datos){
        $editarDeportista = mainModel::conectar()->prepare("UPDATE dat_per SET (nac=:nac, ced=:ced, nom=:nom, ape=:ape, fec_nac=:fec_nac, cod_gen=cod_gen) WHERE cod_per=:cod_per");
       $editarDeportista->bindParam(":nac", $datos['nac']);
       $editarDeportista->bindParam(":ced", $datos['ced']);
       $editarDeportista->bindParam(":nom", $datos['nom']);
       $editarDeportista->bindParam(":ape", $datos['ape']);
       $editarDeportista->bindParam(":fec_nac", $datos['fec_nac']);
       $editarDeportista->bindParam(":cod_gen", $datos['cod_gen']);
       $editarDeportista->execute();
       return $editarDeportista;
    }

  

}
