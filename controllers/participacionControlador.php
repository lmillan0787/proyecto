<?php

if ($peticionAjax) {
    require_once "../models/participacionModelo.php";
} else {
    require_once "./models/participacionModelo.php";
}

class participacionControlador extends participacionModelo
{
    ///////////////////////////////////////////////////////////////////////////////
    public function tabla_participacion($datos)
    {  
        $cod_even = mainModel::limpiar_cadena($datos['cod_even']);

        $datos = [
            "cod_even" => $cod_even
        ];

        $sql = participacionModelo::consultar_participacion_modelo($datos);
        $n = 0;
        foreach ($sql as $row) {
            echo $row['cod_par'];

            $n++;

            if ($row['cod_rol'] == 2) {
                $form = '
                <form action="' . SERVERURL . 'ajax/participacionFpdfAjax.php" method="POST" target="_blank" rel="noopener noreferrer">  
                    <input type="text" name="cod_even" value="' . $row['cod_even'] . '" hidden>
                    <input type="text" name="cod_per" value="' . $row['cod_per'] . '" hidden>
                    <input type="text" name="cod_par" value="' . $row['cod_par'] . '" hidden>                      
                    <button type="submit" class="btn btn-warning btn-sm">
                        <i class="far fa-address-card fa-2x"></i>                            
                    </button>
                </form>
                ';
            } else if ($row['cod_rol'] == 4) {
                $form = '
                <form action="' . SERVERURL . 'ajax/participacionFpdfAjax.php" method="POST" target="_blank" rel="noopener noreferrer">
                    <input type="text" name="cod_even" value="' . $row['cod_even'] . '" hidden>
                    <input type="text" name="cod_per" value="' . $row['cod_per'] . '" hidden>
                    <input type="text" name="cod_par" value="' . $row['cod_par'] . '" hidden>                             
                    <button type="submit" class="btn btn-warning btn-sm">
                        <i class="far fa-address-card fa-2x"></i>                            
                    </button>
                </form>
                ';
            } else if ($row['cod_rol'] == 5) {
                $form = '
                <form action="' . SERVERURL . 'ajax/participacionFpdfAjax.php" method="POST" target="_blank" rel="noopener noreferrer"> 
                    <input type="text" name="cod_even" value="' . $row['cod_even'] . '" hidden>
                    <input type="text" name="cod_per" value="' . $row['cod_per'] . '" hidden>
                    <input type="text" name="cod_par" value="' . $row['cod_par'] . '" hidden>                            
                    <button type="submit" class="btn btn-warning btn-sm">
                        <i class="far fa-address-card fa-2x"></i>                            
                    </button>
                </form>
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
                <td class="text-center">
                <form class="" action="' . SERVERURL . 'editarPersona" method="POST" enctype="multipart/form-data">
                    <input type="text" value="' . $row['cod_per'] . '" name="cod_per" hidden required>
                    <button type="submit" class="btn btn-default btn-sm">
                        <i class="far fa-edit fa-2x"></i>
                    </button>
                </form>    
                </td>    
            </tr>';
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function datos_credenciales_controlador()
    {
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $datos = [
            "cod_even" => $cod_even
        ];
        $row = participacionModelo::consultar_participacion_modelo($datos);
        foreach ($row as $row) {
            require_once "../controllers/pdfControlador.php";
            $insCredencial = new PDF('p', 'mm', array(100, 90));
            $insCredencial->generar_credencial_controlador1();
        }
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_cedula_controlador()
    {
        $cod_par = mainModel::limpiar_cadena($_POST['cod_par']);
        $datos = [
            "cod_par" => $cod_par
        ];
        $row = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($row as $row) {
            echo '
                 <input type="text" id="ced" class="ced text-capitalize form-control" placeholder="Cédula" aria-describedby="addon-wrapping" minlength="8" maxlength="10"  name="ced" value="' . $row['ced'] . '">                
             ';
        }
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_participacion_editar_evento_controlador()
    {
        $cod_par = mainModel::limpiar_cadena($_POST['cod_par']);
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
    public function formulario_participacion_editar_evento_distinto_controlador()
    {
        $cod_par = mainModel::limpiar_cadena($_POST['cod_par']);
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
    public function formulario_participacion_editar_rol_controlador()
    {
        $cod_par = mainModel::limpiar_cadena($_POST['cod_par']);
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
    public function formulario_participacion_editar_rol_distinto_controlador()
    {
        $cod_par = mainModel::limpiar_cadena($_POST['cod_par']);
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
    public function formulario_participacion_editar_estatus_controlador()
    {
        $cod_par = mainModel::limpiar_cadena($_POST['cod_par']);
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
    public function formulario_participacion_editar_estatus_distinto_controlador()
    {
        $cod_par = mainModel::limpiar_cadena($_POST['cod_par']);
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
    public function formulario_participacion_editar_cargo_controlador()
    {
        $cod_par = mainModel::limpiar_cadena($_POST['cod_par']);
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
    public function formulario_participacion_editar_cargo_distinto_controlador()
    {
        $cod_par = mainModel::limpiar_cadena($_POST['cod_par']);
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
    public function formulario_participacion_editar_institucion_controlador()
    {
        $cod_par = mainModel::limpiar_cadena($_POST['cod_par']);
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
    public function formulario_participacion_editar_institucion_distinta_controlador()
    {
        $cod_par = mainModel::limpiar_cadena($_POST['cod_par']);
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
    public function formulario_participacion_editar_foto_controlador()
    {
        $cod_par = mainModel::limpiar_cadena($_POST['cod_par']);
        $datos = [
            "cod_par" => $cod_par
        ];
        $row = mainModel::formulario_informacion_participacion_modelo($datos);
        foreach ($row as $row) {
            echo '
                <img src="' . SERVERURL . 'views/assets/upload/' . $row['ced'] . '.jpg"/>            
             ';
        }
        return $row;
    }
}
