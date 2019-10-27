<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class deportistaModelo extends mainModel
{
    protected function agregar_deportista($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO dat_par (cod_per,cod_even,cod_perf) VALUES (:cod_per,:cod_even,:cod_perf);
        INSERT INTO dat_del (cod_par,cod_reg,cod_pue,cod_dis,cod_cat) VALUES (LAST_insert_id(),:cod_reg,:cod_pue,:cod_dis,:cod_cat)");
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->bindParam(":cod_perf", $datos['cod_perf']);
        $sql->bindParam(":cod_reg", $datos['cod_reg']);
        $sql->bindParam(":cod_pue", $datos['cod_pue']);
        $sql->bindParam(":cod_dis", $datos['cod_dis']);
        $sql->bindParam(":cod_cat", $datos['cod_cat']);
        $sql->execute();
        return $sql;
    }
    public function consultar_deportista(){
        $consultaDeportista = mainModel::conectar()->prepare("SELECT a.*, b.*, c.*,d.* ,e.*,f.*,g.*,h.*,i.*, TIMESTAMPDIFF(YEAR,a.fec_nac,CURDATE()) AS edad FROM dat_per AS a INNER JOIN dat_par AS b ON b.cod_per=a.cod_per INNER JOIN dat_del AS c ON b.cod_par=c.cod_par INNER JOIN tab_gen AS d  ON a.cod_gen=d.cod_gen INNER JOIN tab_reg AS e ON c.cod_reg=e.cod_reg INNER JOIN tab_pue AS f on f.cod_pue=c.cod_pue INNER JOIN tab_reg AS g ON g.cod_reg=c.cod_reg INNER JOIN tab_dis AS h ON h.cod_dis=c.cod_dis INNER JOIN dat_even AS i on b.cod_even=i.cod_even WHERE cod_perf=4  ORDER BY c.cod_par ASC");
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
