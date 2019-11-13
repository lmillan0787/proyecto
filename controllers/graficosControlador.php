<?php

if ($peticionAjax) {
    require_once "../models/graficosModelo.php";
} else {
    require_once "./models/graficosModelo.php";
}

class graficosControlador extends graficosModelo
{
    public function generar_grafica_torta_controlador($datos)
    {
        
        $row = graficosModelo::graficos_torta_modelo($datos);
    
        foreach($row as $row){
            $datosTorta="['".$row['des_reg']."', ".$row['total']."],";
            echo $datosTorta;
        } 
    }
    ///////////////////////////////////////////////////////////////
    //disc
    public function generar_grafica_regiones_controlador($datos)
    {
        
        $row = graficosModelo::graficos_torta_modelo($datos);
    
        foreach($row as $row){
            $datosTorta="['".$row['des_reg']."'],";
            echo $datosTorta;
        } 
    }
    ///////////////////////////////////////////////////////////////
    //disc
    public function generar_grafica_disciplinas_controlador($datos)
    {
        $row = graficosModelo::graficos_disciplinas_modelo($datos);
        foreach($row as $row){
            $datosTorta="['".$row['des_dis']."', ".$row['total']."],";
            echo $datosTorta;
        } 
    }
    public function generar_grafica_disciplinas_nombres_controlador($datos)
    {
        $row = graficosModelo::graficos_disciplinas_modelo($datos);
        foreach($row as $row){
            $datosTorta="['".$row['des_dis']."'],";
            echo $datosTorta;
        } 
    }
    //////////////////////////////////////////////////////////////////
    //disc
    public function generar_grafica_pueblos_controlador($datos)
    {
        
        $row = graficosModelo::graficos_pueblos_modelo($datos);
    
        foreach($row as $row){
            $datosTorta="['".$row['des_pue']."', ".$row['total']."],";
            echo $datosTorta;
        } 
    }
    public function generar_grafica_pueblos_nombres_controlador($datos)
    {
        $row = graficosModelo::graficos_pueblos_modelo($datos);
        foreach($row as $row){
            $datosTorta="['".$row['des_pue']."'],";
            echo $datosTorta;
        } 
    }
}
