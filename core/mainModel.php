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


    //encryptar datos
    protected function encryption($string)
    {
        $output = FALSE;
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = onpenssl_encrypt($string, METHOD, $key, 0, $iv);
        return $output;
    }
    //desencriptar datos
    protected function description($string)
    {

        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = onpenssl_descript(base64_decode($string), METHOD, $key, 0, $iv);
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
        } else if ($datos['Alerta'] == "recargar") {
            $alerta = "
                    <script>
                        Swal.fire(
                            '" . $datos['Titulo'] . "',
                            '" . $datos['Texto'] . "',
                            '" . $datos['Tipo'] . "'
                        ).then(function(){
                            location.reload();
                        });  
                    </script>
                ";
        } else if ($datos['Alerta'] == "simplePersona") {
            $alerta = "
                    <script>
                        Swal.fire(
                            '" . $datos['Titulo'] . "',
                            '" . $datos['Texto'] . "',
                            '" . $datos['Tipo'] . "'
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
            
        }
        return $alerta;
    }
}
