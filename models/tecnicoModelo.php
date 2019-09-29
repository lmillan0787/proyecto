<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class tecnicoModelo extends mainModel
{
    protected function agregar_tecnico($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO dat_par(cod_per,cod_even,cod_perf) VALUES (:cod_per,:cod_even,:cod_perf)");
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->bindParam(":cod_perf", $datos['cod_perf']);        
        $sql->execute();
        return $sql;
    }
    public function consultar_tecnico(){
        $consultaTecnico = mainModel::conectar()->prepare("select * from dat_per a,dat_par b, dat_per_tec c,tab_gen d, tab_inst e,dat_even f,tab_carg g where a.cod_per=b.cod_per and b.cod_par=c.cod_par and a.cod_gen=d.cod_gen and c.cod_inst=e.cod_inst and b.cod_even=f.cod_even and c.cod_carg=g.cod_carg");
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

    protected function registro($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO dat_per(cod_per,cod_even,cod_perf) VALUES (:cod_per,:cod_even,:cod_perf)");
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->bindParam(":cod_perf", $datos['cod_perf']);        
        $sql->execute();
        return $sql;
    }


public function id(){
    
        $consultaId = mainModel::conectar()->prepare("SELECT * FROM dat_per  WHERE ced='$ced'");
        $consultaId->execute();
        $row = $consultaId->fetchAll(PDO::FETCH_ASSOC);
        return $row;
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
  
  
    public function insertar_tecnico(){

$insertarTecnico= mainModel::conectar()->beginTransaction();
$insertarTecnico->query("insert INTO dat_per (nac,ced,nom,ape,fec_nac,cod_gen) VALUES
(1,30003003,'jhon','Chancellor','1994-07-06',1)");


$insertarTecnico->query("INSERT INTO dat_par (cod_per,cod_even,cod_perf) values 

(last_insert_id(),43,7)");


$insertarTecnico->query("insert INTO dat_per_tec (cod_par,cod_inst,cod_carg) VALUES 

(LAST_insert_id(),2,5)");




    }

}