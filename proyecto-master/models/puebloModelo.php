<?php

    if($peticionAjax){
        require_once "../core/mainModel.php";
    }else{
        require_once "./core/mainModel.php";
    }
    
    class puebloModelo extends mainModel{
        protected function agregar_pueblo($datos){
            $sql=mainModel::conectar()->prepare("INSERT INTO tab_pue(des_pue) VALUES :des_pue");
            $sql->bindParam(":des_pue",$datos['des_pue']);
            $sql->execute();
            return $sql;
        }

 public function consultar_pueblo(){
        $consultaPueblo = mainModel::conectar()->prepare("SELECT * FROM tab_pue");
        $consultaPueblo->execute();
        $row = $consultaPueblo->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }



    }
    