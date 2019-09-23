<?php

if ($peticionAjax) {
    require_once "./models/tecnicoModelo.php";
} else {
    require_once "./models/tecnicoModelo.php";
}

class tecnicoControlador extends tecnicoModelo
{
    public function agregar_tecnico_controlador()
    {
        $nac = mainModel::limpiar_cadena($_POST['cod_per']);
        $ced = mainModel::limpiar_cadena($_POST['cod_even']);
        $nom = mainModel::limpiar_cadena($_POST['cod_perf']);
        $ape = mainModel::limpiar_cadena($_POST['ape']);
       

        $validarCedula = tecnicoModelo::validar_cedula($ced);
        if ($validarCedula->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "La cédula que intenta ingresar ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
        } else {
            $datostecnico = [
                "nac" => $cod_per,
                "ced" => $cod_even,
                "nom" => $cod_perf,
                
            ];
            $guardartecnico = tecnicoModelo::agregar_tecnico($datostecnico);

            if ($guardartecnico->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simpletecnico",
                    "Titulo" => "",
                    "Texto" => "tecnico registrada exitosamente",
                    "Tipo" => "success"
                ];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Error al registrar tecnico",
                    "Tipo" => "error"
                ];
            }
        }
        return mainModel::sweet_alert($alerta);
    }
    public function tabla_tecnico(){
        
        $row=tecnicoModelo::consultar_tecnico();
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
                <td><button class="btn btn-success btn-md my-2 my-sm-0 ml-3" type="submit" ><a href="../regtecnico.php?nom='.$row['nom'].'">Ver</a></button></td>
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

    $row=tecnicoModelo::id();
        foreach  
          ($row as $row){
        
            echo $row['cod_per'];
            
         }}

         public function imprimirNombre(){

    $row=tecnicoModelo::id();
        foreach  
          ($row as $row){
        
            
            echo $row['nom'];
         }
     }
        
public function consultarCargo(){

    $row=tecnicoModelo::consultaCargo();
        echo '<select name="cod_carg" id="cod_carg" class="form-control">';
        foreach  ($row as $row){
        
echo '<option  value="'.$row['cod_carg'].'" >'.$row['des_carg'].'</option>'
            ;}

            echo '</select>';
}

public function consultarInstitucion(){

    $row=tecnicoModelo::consultaInstitucion();
        echo '<select name="cod_inst" id="cod_inst" class="form-control">';
        foreach  ($row as $row){
        
echo '<option  value="'.$row['cod_inst'].'" >'.$row['des_inst'].'</option>'
            ;}

            echo '</select>';
}

}


