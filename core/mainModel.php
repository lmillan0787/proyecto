<?php
if ($peticionAjax) {
    require_once "../core/configAPP.php";
} else {
    require_once "./core/configAPP.php";
}
class mainModel
{
    //conexion a la base de datos
    protected function conectar()
    {

        try {
            $enlace = new PDO(SGDB, USER, PASS);
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
        return $enlace;
    }
    //consulta simple
    protected function ejecutar_consulta_simple($consulta)
    {

        $respuesta = self::conectar()->prepare($consulta);
        $respuesta->execute();
        return $respuesta;
    }

    //validar cedula
    public function validar_cedula_modelo($ced){
        $validarCedula = mainModel::conectar()->prepare("SELECT * FROM dat_per WHERE ced='$ced'");
        $validarCedula->execute();
        return $validarCedula;
    }
    //econsultar persona
    public function consultar_persona_modelo(){
        $consultaPersona = mainModel::conectar()->prepare("SELECT a.*, b.*, c.*, TIMESTAMPDIFF(YEAR,a.fec_nac,CURDATE()) AS edad FROM dat_per AS a INNER JOIN tab_gen AS b ON a.cod_gen=b.cod_gen INNER JOIN tab_nac AS c ON a.cod_nac=c.cod_nac");
        $consultaPersona->execute();
        $row = $consultaPersona->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } 
    //encryptar datos
    protected function encryption($string)
    {
        $output = FALSE;
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }
    //desencriptar datos
    protected function description($string)
    {

        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = onpenssl_descrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
    }
    //funcion para crear numero aleatorios
    protected function generar_codigo_aleatorio($letra, $longitud, $num)
    {

        for ($i = 1; $i <= $longitud; $i++) {
            $numero = rad(0, 9);
            $letra .= $numero;
        }
        return $letra . $num;
    }
    //proteger de iyecciones SQL
    protected function limpiar_cadena($cadena)
    {

        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);
        $cadena = str_ireplace("<script>", "", $cadena);
        $cadena = str_ireplace("</script>", "", $cadena);
        $cadena = str_ireplace("<script src>", "", $cadena);
        $cadena = str_ireplace("<script type>", "", $cadena);
        $cadena = str_ireplace("SELECT * FROM", "", $cadena);
        $cadena = str_ireplace("DELETE FROM", "", $cadena);
        $cadena = str_ireplace("INSERT INTO", "", $cadena);
        $cadena = str_ireplace("--", "", $cadena);
        $cadena = str_ireplace("^", "", $cadena);
        $cadena = str_ireplace("[", "", $cadena);
        $cadena = str_ireplace("]", "", $cadena);
        $cadena = str_ireplace("==", "", $cadena);
        $cadena = str_ireplace(";", "", $cadena);
        return $cadena;
    }

    protected function sweet_alert($datos)
    {

        if ($datos['Alerta'] == "simple") {
            $alerta = "
                    <script>
                        Swal.fire(
                            '" . $datos['Titulo'] . "',
                            '" . $datos['Texto'] . "',
                            '" . $datos['Tipo'] . "'
                        ).then(function(){
                           
                        });
                    </script>
                ";
        } else if ($datos['Alerta'] == "limpiar") {
            $alerta = "
                    <script>
                        Swal.fire(
                            '" . $datos['Titulo'] . "',
                            '" . $datos['Texto'] . "',
                            '" . $datos['Tipo'] . "'                            
                        )
                    </script>
                ";
        } else if ($datos['Alerta'] == "confirmarCedula") {
            $alerta = "
                    <script>
                    Swal.fire({
                        title: 'La Cédula no se encuentra registrada',
                        text: 'Desea registrar a la persona?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Registrar Persona'
                      }).then((result) => {
                        if (result.value) {
                            window.location='" . SERVERURL . "registrarPersona/';
                        }
                      })  
                    </script>
                ";
        } else if ($datos['Alerta'] == "simplePersona") {
            $alerta = "
                    <script>
                        Swal.fire(
                            '" . $datos['Titulo'] . "',
                            '" . $datos['Texto'] . "',
                            '" . $datos['Tipo'] . "',
                        ).then(function(){
                            window.location='" . SERVERURL . "personas/';
                        });
                    </script>
                ";
        } else if ($datos['Alerta'] == "simpleEventos") {
            $alerta = "
                    <script>
                        Swal.fire(
                            '" . $datos['Titulo'] . "',
                            '" . $datos['Texto'] . "',
                            '" . $datos['Tipo'] . "'
                        ).then(function(){
                            window.location='" . SERVERURL . "eventos/';
                        });
                    </script>
                ";
        } else if ($datos['Alerta'] == "simpleUsuarios") {
            $alerta = "
                    <script>
                        Swal.fire(
                            '" . $datos['Titulo'] . "',
                            '" . $datos['Texto'] . "',
                            '" . $datos['Tipo'] . "'
                        ).then(function(){
                            window.location='" . SERVERURL . "usuarios/';
                        });
                    </script>
                ";
            
        } else if ($datos['Alerta'] == "simpleLogin"){
 $alerta = "<script>
                        Swal.fire(
                            '" . $datos['Titulo'] . "',
                            '" . $datos['Texto'] . "',
                            '" . $datos['Tipo'] . "'
                        ).then(function(){
                            window.location='" . SERVERURL . "home/';
                        });
                    </script>
                ";

        }
        return $alerta;
    }
}
