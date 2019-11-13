<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class tecnicoModelo extends mainModel
{
    protected function agregar_tecnico($datos){
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
    public function consultar_tecnico(){
        $consultaTecnico = mainModel::conectar()->prepare("SELECT a.*, b.*, c.*, d.*, e.*, f.*, g.*, h.* FROM dat_per_tec AS a INNER JOIN dat_par AS b ON a.cod_par=b.cod_par INNER JOIN dat_per AS c on c.cod_per=b.cod_per INNER JOIN dat_even AS d ON d.cod_even=b.cod_even INNER JOIN tab_inst AS e ON e.cod_inst=a.cod_inst INNER JOIN tab_carg AS f ON f.cod_carg=a.cod_carg INNER JOIN tab_perf AS g ON g.cod_perf=b.cod_perf INNER JOIN tab_estat AS h ON h.cod_estat=b.cod_estat");
        $consultaTecnico->execute();
        $row = $consultaTecnico->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    public function consultar_tecnico_especifico(){
        $consultaTecnico = mainModel::conectar()->prepare("SELECT a.*, b.*, c.*, d.*, e.*, f.*, g.*, h.* FROM dat_per_tec AS a INNER JOIN dat_par AS b ON a.cod_par=b.cod_par INNER JOIN dat_per AS c on c.cod_per=b.cod_per INNER JOIN dat_even AS d ON d.cod_even=b.cod_even INNER JOIN tab_inst AS e ON e.cod_inst=a.cod_inst INNER JOIN tab_carg AS f ON f.cod_carg=a.cod_carg INNER JOIN tab_perf AS g ON g.cod_perf=b.cod_perf INNER JOIN tab_estat AS h ON h.cod_estat=b.cod_estat WHERE b.cod_per=:cod_per");
        $consultaTecnico->execute();
        $row = $consultaTecnico->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    public function validar_cedula($ced){
        $validarCedula = mainModel::conectar()->prepare("SELECT * FROM dat_per WHERE ced='$ced'");
        $validarCedula->execute();
        return $validarCedula;

    }
    protected function editar_tecnico($datos){
        $editarTecnico = mainModel::conectar()->prepare("UPDATE dat_par SET (nac=:nac, ced=:ced, nom=:nom, ape=:ape, fec_nac=:fec_nac, cod_gen=cod_gen) WHERE cod_per=:cod_per");
       $editarTecnico->bindParam(":nac", $datos['nac']);
       $editarTecnico->bindParam(":ced", $datos['ced']);
       $editarTecnico->bindParam(":nom", $datos['nom']);
       $editarTecnico->bindParam(":ape", $datos['ape']);
       $editarTecnico->bindParam(":fec_nac", $datos['fec_nac']);
       $editarTecnico->bindParam(":cod_gen", $datos['cod_gen']);
       $editarTecnico->execute();
       return $editarTecnico;
    }

   


    public function consultaCargo(){
       $consultaCargo = mainModel::conectar()->prepare("SELECT * FROM tab_carg");
        $consultaCargo->execute();
        $row = $consultaCargo->fetchAll(PDO::FETCH_ASSOC);
        return $row;

    }

    public function consultaInstitucion(){
       $consultaInstitucion = mainModel::conectar()->prepare("SELECT * FROM tab_inst");
        $consultaInstitucion->execute();
        $row = $consultaInstitucion->fetchAll(PDO::FETCH_ASSOC);
        return $row;

    }
  
  
   

}