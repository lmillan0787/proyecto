<?php

if ($peticionAjax) {
    require_once "../models/usuarioModelo.php";
} else {
    require_once "./models/usuarioModelo.php";
}

class usuarioControlador extends usuarioModelo
{
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function agregar_usuario_controlador()
    {
        $cod_nac = mainModel::limpiar_cadena($_POST['cod_nac']);
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $nom = mainModel::limpiar_cadena($_POST['nom']);
        $ape = mainModel::limpiar_cadena($_POST['ape']);
        $fec_nac = mainModel::limpiar_cadena($_POST['fec_nac']);
        $cod_gen = mainModel::limpiar_cadena($_POST['cod_gen']);

        $validarCedula = usuarioModelo::validar_cedula_modelo($ced);
        if ($validarCedula->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "La cédula que intenta ingresar ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
        } else {
            $datosUsuario = [
                "cod_nac" => $cod_nac,
                "ced" => $ced,
                "nom" => $nom,
                "ape" => $ape,
                "fec_nac" => $fec_nac,
                "cod_gen" => $cod_gen
            ];
            $guardarUsuario = usuarioModelo::agregar_usuario_modelo($datosUsuario);

            if ($guardarUsuario->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simpleUsuario",
                    "Titulo" => "",
                    "Texto" => "Usuario registrada exitosamente",
                    "Tipo" => "success"
                ];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Error al registrar usuario",
                    "Tipo" => "error"
                ];
            }
        }
        return mainModel::sweet_alert($alerta);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_usuario()
    {
        $row = usuarioModelo::consultar_usuario_modelo();
        foreach ($row as $row) {
            echo '
            <tr>
                <td>' . $row['cod_per'] . '</td>
                <td>' . $row['des_nac'] . '</td>
                <td>' . $row['ced'] . '</td>
                <td>' . $row['nom'] . '</td>
                <td>' . $row['ape'] . '</td>
                <td>' . $row['des_gen'] . '</td>
                <td>' . $row['edad'] . '</td>                
                <td>
                    <form class="" action="' . SERVERURL . 'editarUsuario" method="POST" enctype="multipart/form-data">
                        <input type="text" value="' . $row['cod_per'] . '" name="cod_per" hidden required>
                        <button type="submit" class="btn btn-info btn-md">
                            <i class="far fa-edit fa-2x"></i>
                        </button>
                    </form>    
                </td>    
            
                <td>
                    <form class="FormularioAjax" action="' . SERVERURL . 'ajax/eliminarUsuarioAjax.php" method="POST" data-form="borrar" enctype="multipart/form-data">
                        <input type="text" value="' . $row['cod_per'] . '" name="cod_per" hidden required>
                        <button type="submit" class="btn btn-danger btn-md">
                            <i class="far fa-trash-alt fa-2x"></i>                            
                        </button>
                        <div class="RespuestaAjax"></div>
                    </form>
                </td>
            </tr>';
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function consultar_usuario2()
    {
        $cod_per = mainModel::limpiar_cadena($_POST['cod_per']);

        $consultaUsuario = mainModel::ejecutar_consulta_simple("SELECT a.*, b.*, c.* FROM dat_per AS a INNER JOIN tab_gen AS b ON a.cod_gen=b.cod_gen INNER JOIN tab_nac AS c ON a.cod_nac=c.cod_nac WHERE cod_per=$cod_per");
        $row = $consultaUsuario->fetchAll(PDO::FETCH_ASSOC);

        foreach ($row as $row) {

            echo '    
            
            <div class="card" id="form_ini">

            <h5 class="card-header info-color white-text text-center py-4">
                <strong>Datos Básicos</strong>
            </h5>
            <!--Formulario de inicio-->
            <div class="card-body px-lg-5">
                <form class="FormularioAjax" action="'.SERVERURL.'ajax/editarUsuarioAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
                    <input type="text" value="' . $row['cod_per'] . '" name="cod_per" hidden required>
                    <div class="text-center">
                    </div>
                    <!-- Nacionalidad-->
                    <label for="textInput">Nacionalidad:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-globe-americas prefix grey-text"></i></label>
                        </div>
                        <select class="browser-default custom-select" id="inputGroupSelect01" name="cod_nac" required>
                            <option value="' . $row['cod_nac'] . '">' . $row['des_nac'] . '</option>
                            <option value="1">Venezolana</option>
                            <option value="2">Extranjera</option>
                        </select>
                    </div>
                    <!-- Cédula-->
                    <label for="textInput">Cédula:</label>
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                        </div>
                        <input value="' . $row['ced'] . '" type="text" id="ced" class="form-control" placeholder="Cédula" aria-describedby="addon-wrapping" minlength="6" maxlength="8" required pattern="[0-9]+" name="ced">                
                    </div>
                    <div id="result-ced"></div>
                    <!-- Nombre-->
                    <label for=" textInput">Nombre:</label>
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                        </div>
                        <input value="' . $row['nom'] . '" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" placeholder="Nombre" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="nom">
                    </div>
                    <!-- Apellido-->
                    <label for="textInput">Apellido:</label>
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                        </div>
                        <input value="' . $row['ape'] . '" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" placeholder="Apellido" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="ape">
                    </div>
                    <!-- Fecha de nacimiento-->
                    <label for="textInput">Fecha de nacimiento:</label>
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping"><i class="far fa-calendar-alt prefix grey-text"></i></span>
                        </div>
                        <input value="' . $row['fec_nac'] . '" type="date" class="form-control" placeholder="Fecha de nacimiento" aria-label="Username" aria-describedby="addon-wrapping" min="1930-01-01" max="2010-01-01" step="1" name="fec_nac">
                    </div>
                    <!-- Género-->
                    <label for="textInput">Género:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-venus-mars prefix grey-text"></i></label>
                        </div>
                        <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_gen" name="cod_gen" required>
                            <option value="' . $row['cod_gen'] . '">' . $row['des_gen'] . '</option>
                            <option value="1">Masculino</option>
                            <option value="2">Femenino</option>
                        </select>
                    </div>
                    <button class="btn btn-info btn-block" type="submit">Editar</button>
                    <div class="RespuestaAjax"></div>                    
                </form>
            </div>
        </div>';
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function editar_usuario_controlador()
    {
        $cod_per = mainModel::limpiar_cadena($_POST['cod_per']);
        $cod_nac = mainModel::limpiar_cadena($_POST['cod_nac']);
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $nom = mainModel::limpiar_cadena($_POST['nom']);
        $ape = mainModel::limpiar_cadena($_POST['ape']);
        $fec_nac = mainModel::limpiar_cadena($_POST['fec_nac']);
        $cod_gen = mainModel::limpiar_cadena($_POST['cod_gen']);

        $datosUsuario = [
            "cod_per" => $cod_per,
            "cod_nac" => $cod_nac,
            "ced" => $ced,
            "nom" => $nom,
            "ape" => $ape,
            "fec_nac" => $fec_nac,
            "cod_gen" => $cod_gen
        ];
        $editarUsuario = usuarioModelo::editar_usuario_modelo($datosUsuario);
        
        if ($editarUsuario->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "simpleUsuario",
                "Titulo" => "",
                "Texto" => "Usuario actualizada exitosamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "Error al actualizar usuario",
                "Tipo" => "error"
            ];
        }
        return mainModel::sweet_alert($alerta);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function eliminar_usuario_controlador()
    {
        $cod_per = mainModel::limpiar_cadena($_POST['cod_per']);

        $datosUsuario = [
            "cod_per" => $cod_per
        ];
        $eliminarUsuario = usuarioModelo::eliminar_usuario_modelo($datosUsuario);

        if ($eliminarUsuario->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "simpleUsuario",
                "Titulo" => "",
                "Texto" => "Usuario eliminada del sistema exitosamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "Error al registrar usuario",
                "Tipo" => "error"
            ];
        }
        return mainModel::sweet_alert($alerta);
    }
    public function formulario_usuario()
    {
        $consultaEdo = mainModel::ejecutar_consulta_simple("SELECT * FROM tab_perf WHERE cod_rol='1'");
        $row = $consultaEdo->fetchAll(PDO::FETCH_ASSOC);
        foreach ($row as $row) {

            echo '<option value="' . $row['cod_perf'] . '">' . $row['des_perf'] . '</option>';
        }
        return $row;
    }
}
