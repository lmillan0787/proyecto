<?php

if ($peticionAjax) {
    require_once "../models/participacionModelo.php";
} else {
    require_once "./models/participacionModelo.php";
}

class participacionControlador extends participacionModelo
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_participacion($datos)
    {  
        $cod_even = mainModel::limpiar_cadena($datos['cod_even']);
        $datos = [
            "cod_even" => $cod_even
        ];
        $sql = participacionModelo::lista_participacion_modelo($datos);
        $n = 0;
        foreach ($sql as $row) {
            $datos = [
                "cod_par" => $row['cod_par']
            ];
            $n++;
            if ($row['cod_rol'] == 2) {   
                $sql = participacionModelo::lista_participacion_delegaciones_modelo($datos);
                foreach ($sql as $row){
                    $alias = $row['alias'];
                    $des_pue = $row['des_pue'];
                    $des_dis = $row['des_dis'];
                }
                $form = '
                <form action="' . SERVERURL . 'ajax/participacionFpdfAjax.php" method="POST" target="_blank" rel="noopener noreferrer">
                    <input type="text" name="ced" value="' . $row['ced'] . '" hidden>
                    <input type="text" name="nombre" value="' . $row['nom'] . '" hidden>
                    <input type="text" name="apellido" value="' . $row['ape'] . '" hidden>
                    <input type="text" name="cod_perf" value="' . $row['cod_perf'] . '" hidden>
                    <input type="text" name="cod_rol" value="' . $row['cod_rol'] . '" hidden>
                    <input type="text" name="alias" value="' .$alias. '" hidden>
                    <input type="text" name="des_pue" value="' . $des_pue. '" hidden>
                    <input type="text" name="des_dis" value="' . $des_dis. '" hidden>
                    <input type="text" name="cod_reg" value="' . $row['cod_reg'] . '" hidden>
                    <input type="text" name="des_even" value="' . $row['des_even'] . '" hidden>
                    <input type="text" name="cod_even" value="' . $row['cod_even'] . '" hidden>
                    <input type="text" name="cod_per" value="' . $row['cod_per'] . '" hidden>
                    <input type="text" name="cod_par" value="' . $row['cod_par'] . '" hidden>                      
                    <button type="submit" class="btn btn-warning btn-sm">
                        <i class="far fa-address-card fa-2x"></i>                            
                    </button>
                </form>
                ';
                if($row['cod_perf'] == 4){
                    $editar='
                                <a href="' . SERVERURL . 'editarDeportista/' . $row['cod_par'] . '/">
                                    <button type="submit" class="btn btn-default btn-sm">
                                        <i class="far fa-edit fa-2x"></i>
                                    </button>
                                </a>  
                            ';
                }else if($row['cod_perf'] == 5){
                    $editar='
                                <a href="' . SERVERURL . 'editarDelegado/' . $row['cod_par'] . '/">
                                    <button type="submit" class="btn btn-default btn-sm">
                                        <i class="far fa-edit fa-2x"></i>
                                    </button>
                                </a>  
                            ';
                }else if($row['cod_perf'] == 6){
                    $editar='
                                <a href="' . SERVERURL . 'editarMedico/' . $row['cod_par'] . '/">
                                    <button type="submit" class="btn btn-default btn-sm">
                                        <i class="far fa-edit fa-2x"></i>
                                    </button>
                                </a>  
                            ';
                }
            } else if ($row['cod_rol'] == 4) {
                $sql = participacionModelo::lista_participacion_tecnicos_modelo($datos);
                foreach ($sql as $row){
                    $des_carg = $row['des_carg'];
                    $siglas = $row['siglas'];
                }
                    $form = '
                    <form action="' . SERVERURL . 'ajax/participacionFpdfAjax.php" method="POST" target="_blank" rel="noopener noreferrer">
                    <input type="text" name="ced" value="' . $row['ced'] . '" hidden>
                    <input type="text" name="nombre" value="' . $row['nom'] . '" hidden>
                    <input type="text" name="apellido" value="' . $row['ape'] . '" hidden>
                    <input type="text" name="des_carg" value="' . $des_carg. '" hidden>
                    <input type="text" name="siglas" value="' . $siglas. '" hidden>
                    <input type="text" name="des_perf" value="' . $row['des_perf'] . '" hidden>
                    <input type="text" name="cod_perf" value="' . $row['cod_perf'] . '" hidden>
                    <input type="text" name="cod_rol" value="' . $row['cod_rol'] . '" hidden>
                    <input type="text" name="des_even" value="' . $row['des_even'] . '" hidden>
                    <input type="text" name="cod_even" value="' . $row['cod_even'] . '" hidden>
                    <input type="text" name="cod_per" value="' . $row['cod_per'] . '" hidden>
                    <input type="text" name="cod_par" value="' . $row['cod_par'] . '" hidden>                             
                    <button type="submit" class="btn btn-warning btn-sm">
                        <i class="far fa-address-card fa-2x"></i>                            
                    </button>
                </form>
                ';
                $editar='
                            <a href="' . SERVERURL . 'editarTecnico/' . $row['cod_par'] . '/">
                                <button type="submit" class="btn btn-default btn-sm">
                                    <i class="far fa-edit fa-2x"></i>
                                </button>
                            </a>  
                        ';
            } else if ($row['cod_rol'] == 5) {
                $form = '
                <form action="' . SERVERURL . 'ajax/participacionFpdfAjax.php" method="POST" target="_blank" rel="noopener noreferrer"> 
                    <input type="text" name="ced" value="' . $row['ced'] . '" hidden>
                    <input type="text" name="nombre" value="' . $row['nom'] . '" hidden>
                    <input type="text" name="apellido" value="' . $row['ape'] . '" hidden>
                    <input type="text" name="cod_perf" value="' . $row['cod_perf'] . '" hidden>
                    <input type="text" name="des_perf" value="' . $row['des_perf'] . '" hidden>
                    <input type="text" name="genero" value="' . $row['des_perf'] . '" hidden>
                    <input type="text" name="cod_rol" value="' . $row['cod_rol'] . '" hidden>
                    <input type="text" name="des_even" value="' . $row['des_even'] . '" hidden>
                    <input type="text" name="cod_even" value="' . $row['cod_even'] . '" hidden>
                    <input type="text" name="cod_per" value="' . $row['cod_per'] . '" hidden>
                    <input type="text" name="cod_par" value="' . $row['cod_par'] . '" hidden>                            
                    <button type="submit" class="btn btn-warning btn-sm">
                        <i class="far fa-address-card fa-2x"></i>                            
                    </button>
                </form>
                ';
                $editar='
                            <a href="' . SERVERURL . 'editarInvitado/' . $row['cod_par'] . '/">
                                <button type="submit" class="btn btn-default btn-sm">
                                    <i class="far fa-edit fa-2x"></i>
                                </button>
                            </a>  
                        ';
            }
            echo '
            <tr>
                <td class="text-center">' . $n . '</td>
                <td class="text-center">' . $row['ced'] . '</td>
                <td class="text-center">' . $row['nom'] . '</td>
                <td class="text-center">' . $row['ape'] . '</td>
                <td class="text-center">' . $row['des_perf'] . '</td>
                <td class="text-center">' . $row['des_estat'] . '</td>
                <td class="text-center">' . $form . '</td>
                <td class="text-center">' . $editar . '</td>
               
            </tr>';
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function credencial_delegacion($datos)
    {
        $cod_even = mainModel::limpiar_cadena($datos['cod_even']);
        $datos = [
            "cod_even" => $cod_even
        ];
        $row = participacionModelo::lista_participacion_modelo($datos);
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_cedula_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $row = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($row as $row) {
            echo '
                 <input type="text" id="ced" class="ced text-capitalize form-control" placeholder="Cédula" aria-describedby="addon-wrapping" minlength="8" maxlength="10"  name="ced" value="' . $row['ced'] . '" required>                
             ';
        }
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_evento_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $row = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($row as $row) {
            echo '
                <option value="' . $row['cod_even'] . '">' . $row['des_even'] . '</option>             
             ';
        }
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_evento_distinto_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $sql = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($sql as $row) {
            $datos = [
                "cod_even" => $row['cod_even']
            ];
        }
        $sql = mainModel::consultar_evento_distinto_modelo($datos);
        foreach ($sql as $row) {
            echo '
                <option value="' . $row['cod_even'] . '">' . $row['des_even'] . '</option>             
             ';
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_rol_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $sql = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($sql as $row) {
            echo '
                <option value="' . $row['cod_perf'] . '">' . $row['des_perf'] . '</option>             
             ';
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_rol_distinto_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $sql = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($sql as $row) {
            $datos = [
                "cod_rol" => $row['cod_rol'],
                "cod_perf" => $row['cod_perf']
            ];
        }
        $sql = mainModel::consultar_perfil_distinto_modelo($datos);
        foreach ($sql as $row) {
            echo '
                <option value="' . $row['cod_perf'] . '">' . $row['des_perf'] . '</option>             
             ';
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_estatus_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $sql = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($sql as $row) {
            echo '
                <option value="' . $row['cod_estat'] . '">' . $row['des_estat'] . '</option>             
             ';
        }
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_estatus_distinto_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $sql = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($sql as $row) {
            $datos = [
                "cod_estat" => $row['cod_estat']
            ];
        }
        $sql = mainModel::consultar_estatus_distinto($datos);
        foreach ($sql as $row) {
            echo '
                <option value="' . $row['cod_estat'] . '">' . $row['des_estat'] . '</option>             
             ';
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_cargo_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $sql = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($sql as $row) {
            echo '
                <option value="' . $row['cod_carg'] . '">' . $row['des_carg'] . '</option>             
             ';
        }
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_cargo_distinto_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $sql = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($sql as $row) {
            $datos = [
                "cod_carg" => $row['cod_carg']
            ];
        }
        $sql = mainModel::consultar_cargo_distinto($datos);
        foreach ($sql as $row) {
            echo '
                <option value="' . $row['cod_carg'] . '">' . $row['des_carg'] . '</option>             
             ';
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_institucion_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $sql = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($sql as $row) {
            echo '
                <option value="' . $row['cod_inst'] . '">' . $row['des_inst'] . '</option>             
             ';
        }
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_institucion_distinta_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $sql = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($sql as $row) {
            $datos = [
                "cod_inst" => $row['cod_inst']
            ];
        }
        $sql = mainModel::consultar_institucion_distinta($datos);
        foreach ($sql as $row) {
            echo '
                <option value="' . $row['cod_inst'] . '">' . $row['des_inst'] . '</option>             
             ';
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_foto_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $row = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($row as $row) {
            echo '
                <img src="' . SERVERURL . 'views/assets/upload/'.$row['ced'].$row['cod_even'].'.jpg"/>            
             ';
        }
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_region_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $row = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($row as $row) {
            echo '
                <option value="' . $row['reg'] . '">' . $row['des_reg'] . '</option>             
             ';
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_region_distinta_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $sql = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($sql as $row) {
            $datos = [
                "cod_reg" => $row['reg']
            ];
        }
        $row = mainModel::consultar_region_distinta_modelo($datos);
        foreach ($row as $row) {
            echo '
                <option value="' . $row['cod_reg'] . '">' . $row['des_reg'] . '</option>             
             ';
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_pueblo_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $row = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($row as $row) {
            echo '
                <option value="' . $row['cod_pue'] . '">' . $row['des_pue'] . '</option>             
             ';
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_pueblo_distinto_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $sql = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($sql as $row) {
            $datos = [
                "cod_pue" => $row['cod_pue']
            ];
        }
        $row = mainModel::consultar_pueblo_distinto_modelo($datos);
        foreach ($row as $row) {
            echo '
                <option value="' . $row['cod_pue'] . '">' . $row['des_pue'] . '</option>             
             ';
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_disciplina_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $row = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($row as $row) {
            echo '
                <option value="' . $row['cod_dis'] . '">' . $row['des_dis'] . '</option>             
             ';
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_disciplina_distinto_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $sql = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($sql as $row) {

            $datos = [
                "cod_dis" => $row['cod_dis'],
                "cod_tip_even" => $row['cod_tip_even']
            ];
        }
        $row = mainModel::consultar_disciplina_distinta_modelo($datos);
        foreach ($row as $row) {
            echo '
                <option value="' . $row['cod_dis'] . '">' . $row['des_dis'] . '</option>             
             ';
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_categoria_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $row = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($row as $row) {
            echo '
                <option value="' . $row['cod_cat'] . '">' . $row['des_cat'] . '</option>             
             ';
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_categoria_distinta_controlador($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $sql = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($sql as $row) {
            
            $datos = [
                "cod_cat" => $row['cod_cat']
            ];
        }
        $row = mainModel::consultar_categoria_distinta_modelo($datos);
        foreach ($row as $row) {
            echo '
                <option value="' . $row['cod_cat'] . '">' . $row['des_cat'] . '</option>             
             ';
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function validar_participacion_evento_distinto($cod_par)
    {
        $cod_par = mainModel::limpiar_cadena($cod_par);
        $datos = [
            "cod_par" => $cod_par
        ];
        $sql = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($sql as $row) {      
            $datos = [
                "cod_even" => $row['cod_even']
            ];
        }
        $row = mainModel::consultar_categoria_distinta_modelo($datos);
        foreach ($row as $row) {
            echo '
                <option value="' . $row['cod_cat'] . '">' . $row['des_cat'] . '</option>             
             ';
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function validar_credencial_participacion_evento($datos)
    {
        $cod_par = mainModel::limpiar_cadena($datos);
        $datos = [
            "cod_par" => $cod_par
        ];
        $sql = mainModel::validar_triple_estatus($datos);
        foreach ($sql as $row) {      
            if (($row['cod_estat_per'] == 1) && ($row['cod_estat_even'] == 1) && ($row['cod_estat_par'] == 1)){
                echo '<script>
                Swal.fire(
                    "Credencial Activa",
                    "'.ucfirst($row['nom']).' '.ucfirst($row['ape']).'<br>'.ucfirst($row['ced']).'<br>'.mb_strtoupper($row['des_even']).'",
                    "success"
                );    
                </script>';
            }else{
                echo '<script>
                Swal.fire(
                    "Credencial Deshabilitada",
                    "'.ucfirst($row['nom']).' '.ucfirst($row['ape']).'<br>'.ucfirst($row['ced']).'<br>'.mb_strtoupper($row['des_even']).'",
                    "error"
                );    
                </script>';
            }
        }                   
        
    }
}
