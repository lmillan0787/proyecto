<?php

if ($peticionAjax) {
    require_once "./models/credencialModelo.php";
} else {
    require_once "./models/credencialModelo.php";
}

class credencialControlador extends credencialModelo
{
    public function agregar_credencial_controlador()
    {
        $nac = mainModel::limpiar_cadena($_POST['cod_per']);
        $ced = mainModel::limpiar_cadena($_POST['cod_even']);
        $nom = mainModel::limpiar_cadena($_POST['cod_perf']);
        $ape = mainModel::limpiar_cadena($_POST['ape']);
       

        $validarCedula = credencialModelo::validar_cedula($ced);
        if ($validarCedula->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "La cédula que intenta ingresar ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
        } else {
            $datoscredencial = [
                "nac" => $cod_per,
                "ced" => $cod_even,
                "nom" => $cod_perf,
                
            ];
            $guardarcredencial = credencialModelo::agregar_credencial($datoscredencial);

            if ($guardarcredencial->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simplecredencial",
                    "Titulo" => "",
                    "Texto" => "credencial registrada exitosamente",
                    "Tipo" => "success"
                ];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Error al registrar credencial",
                    "Tipo" => "error"
                ];
            }
        }
        return mainModel::sweet_alert($alerta);
    }
    public function tabla_credencial(){
        
        $row=credencialModelo::consultar_credencial();
        foreach ($row as $row) {
            if ($row['nac'] == 1) {
                $row['nac'] = 'Venezolano';
            } else {
                $row['nac'] = 'Extranjero';
            }
            echo '
            <tr>
                <td>'.$row['ced'].'</td>
                <td>'.$row['nom'].'</td>
                <td>'.$row['ape'].'</td>
                <td>'.$row['des_carg'].'</td>
                <td>'.$row['fec_even'].'</td>
                <td>'.$row['des_inst'].'</td>
                <td>'.$row['des_even'].'</td>
                <td><button class="btn btn-success btn-md my-2 my-sm-0 ml-3" type="submit" ><a href="../regcredencial.php?nom='.$row['nom'].'">Ver</a></button></td>
                <td><button class="btn btn-success btn-md my-2 my-sm-0 ml-3" type="submit" ><a href="act_dep.php?cod_per='.$row['cod_per'].'">Editar</a></button></td>
            </tr>';
        }
        return $row;
    }


     public function consultarPerfil(){
        $consultarPerfil=mainModel::conectar()->prepare("SELECT cod_perf,des_perf from tab_perf where cod_rol=4 ");
            $consultarPerfil->execute();
            $row = $consultarPerfil->fetchAll(PDO::FETCH_ASSOC);
            echo '<select name="cod_perf" id="cod_perf" class="form-control">';
             foreach ($row as $row) {
            echo '<option value="' . $row['cod_perf'] . '">' . $row['des_perf'] . '</option>';
        }
        
            echo '</select>';
          

}






public function imprimirId(){

    $row=credencialModelo::id();
        foreach  
          ($row as $row){
        
            echo $row['cod_per'];
            
         }}

         public function imprimirNombre(){

    $row=credencialModelo::id();
        foreach  
          ($row as $row){
        
            
            echo $row['nom'];
         }
     }
        
public function consultarCargo(){

    $row=credencialModelo::consultaCargo();
        echo '<select name="cod_carg" id="cod_carg" class="form-control">';
        foreach  ($row as $row){
        
echo '<option  value="'.$row['cod_carg'].'" >'.$row['des_carg'].'</option>'
            ;}

            echo '</select>';
}

public function consultarInstitucion(){

    $row=credencialModelo::consultaInstitucion();
        echo '<select name="cod_inst" id="cod_inst" class="form-control">';
        foreach  ($row as $row){
        
echo '<option  value="'.$row['cod_inst'].'" >'.$row['des_inst'].'</option>'
            ;}

            echo '</select>';
}


public function credencial(){

$row=credencialModelo::consultar_credencial();
 foreach  ($row as $row){
echo $row['cod_per'];
echo $row['nom'];

}}

}


