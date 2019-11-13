<?php

if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class graficosModelo extends mainModel
{
    protected function graficos_torta_modelo($datos)

    {
        $sql = mainModel::conectar()->prepare("SELECT c.*,d.*, COUNT(*) AS total,des_reg FROM dat_del AS a INNER JOIN tab_reg AS b ON a.cod_reg=b.cod_reg INNER JOIN dat_par AS c ON a.cod_par=c.cod_par INNER JOIN dat_even AS d ON c.cod_even=d.cod_even WHERE d.cod_even=:cod_even group by b.cod_reg ");
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function graficos_disciplinas_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT c.*,d.*,COUNT(*) AS total,des_dis FROM dat_del a INNER JOIN tab_dis AS b ON a.cod_dis=b.cod_dis INNER JOIN dat_par AS c ON a.cod_par=c.cod_par INNER JOIN dat_even AS d ON c.cod_even=d.cod_even WHERE d.cod_even=:cod_even group by b.cod_dis");
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function graficos_pueblos_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT COUNT(*) AS total,des_pue FROM dat_del a INNER JOIN tab_pue AS b ON a.cod_pue=b.cod_pue INNER JOIN dat_par AS c ON a.cod_par=c.cod_par where c.cod_even=:cod_even group by b.cod_pue");
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    


}
