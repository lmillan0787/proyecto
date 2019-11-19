<?php
if ($peticionAjax) {
    require_once "../core/configAPP.php";
} else {
    require_once "./core/configAPP.php";
}
class mainModel
{
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consulta simple
    protected function ejecutar_consulta_simple($consulta)
    {
        $respuesta = self::conectar()->prepare($consulta);
        $respuesta->execute();
        return $respuesta;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar region
    protected function consultar_region_modelo(){
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_reg");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar region
    protected function consultar_region_distinta_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_reg WHERE cod_reg!=:cod_reg");
        $sql->bindParam(":cod_reg", $datos['cod_reg']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar estatus
    protected function consultar_estatus_modelo(){
        $consultaEstado = mainModel::conectar()->prepare("SELECT * FROM tab_estat");
        $consultaEstado->execute();
        $row = $consultaEstado->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar estatus
    protected function consultar_estatus_distinto($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_estat WHERE cod_estat!=:cod_estat");
        $sql->bindParam(":cod_estat", $datos['cod_estat']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //desencriptar datos
    protected function description($string)
    {

        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = onpenssl_descrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //funcion para crear numero aleatorios
    protected function generar_codigo_aleatorio($letra, $longitud, $num)
    {

        for ($i = 1; $i <= $longitud; $i++) {
            $numero = rad(0, 9);
            $letra .= $numero;
        }
        return $letra . $num;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
        }else if ($datos['Alerta'] == "simpleDisciplina") {
            $alerta = "
                    <script>
                        Swal.fire(
                            '" . $datos['Titulo'] . "',
                            '" . $datos['Texto'] . "',
                            '" . $datos['Tipo'] . "'
                        ).then(function(){
                            window.location='" . SERVERURL . "disciplinas/';
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
