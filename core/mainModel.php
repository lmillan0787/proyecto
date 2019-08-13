<?php
if ($peticionAjax) {
    require_once "../core/configAPP.php";
} else {
    require_once "./core/configAPP.php";
}
class mainModel
{
    //conexion a la base de datos
    protected function conectar(){

        try {
            $enlace = new PDO(SGDB, USER, PASS);
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
        return $enlace;
    }
    //consulta simple
    protected function ejecutar_consulta_simple($consulta){

        $respuesta = self::conectar()->prepare($consulta);
        $respuesta->execute();
        return $respuesta;
    }

    //agregar persona
    protected function agregar_persona($datos){

        $sql = mainModel::conectar()->prepare("INSERT INTO dat_per(nac,ced,nom,ape,fec_nac,cod_gen) VALUES (:nac,:ced,:nom,:ape,:fec_nac,:cod_gen)");
        $sql->bindParam(":nac", $datos['nac']);
        $sql->bindParam(":ced", $datos['ced']);
        $sql->bindParam(":nom", $datos['nom']);
        $sql->bindParam(":ape", $datos['ape']);
        $sql->bindParam(":fec_nac", $datos['fec_nac']);
        $sql->bindParam(":des_gen", $datos['cod_gen']);
        $sql->execute();
        return $sql;
    }
    /*
        //eliminar persona
        protected function eliminar_persona($cod_per){
            $sql=self::conectar()->prepare("DELETE FROM cuenta WHERE cod_per=:cod_per");
            $sql->bindParam(":cod_per",$cod_per['cod_per']);
            $sql->execute();
            return $sql;
        }*/
    //agregar usuario
    protected function agregar_usuario($datos){

        $sql = self::conectar()->prepare("INSERT INTO `dat_usr`(`cod_per`, `des_usr`, `des_inst`, `des_carg`, `clave`, `cod_perf`, `cod_aud`) VALUES (:cod_per,:des_usr,:des_inst,:des_carg,:clave,:cod_perf,:cod_Aud)");
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->bindParam(":des_usr", $datos['des_usr']);
        $sql->bindParam(":des_inst", $datos['des_inst']);
        $sql->bindParam(":des_carg", $datos['des_carg']);
        $sql->bindParam(":clave", $datos['clave']);
        $sql->bindParam(":cod_perf", $datos['cod_perf']);
        $sql->bindParam(":cod_aud", $datos['cod_aud']);
        $sql->execute();
        return $sql;
    }
    //eliminar usuario
    protected function eliminar_usuario($cod_usr){

        $sql = self::conectar()->prepare("DELETE FROM usuario WHERE cod_usr=:cod_usr");
        $sql->bindParam(":cod_usr", $cod_usr['cod_usr']);
        $sql->execute();
        return $sql;
    }
    //encryptar datos
    protected function encryption($string){

        $output = FALSE;
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = onpenssl_encrypt($string, METHOD, $key, 0, $iv);
        return $output;
    }
    //desencriptar datos
    protected function descryption($string){

        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = onpenssl_descrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
    }
    //funcion para crear numero aleatorios
    protected function generar_codigo_aleatorio($letra, $longitud, $num){

        for ($i = 1; $i <= $longitud; $i++) {
            $numero = rad(0, 9);
            $letra .= $numero;
        }
        return $letra . $num;
    }
    //proteger de iyecciones SQL
    protected function limpiar_cadena($cadena){

        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);
        $cadena = str_ireplace("<scrypt>", "", $cadena);
        $cadena = str_ireplace("</scrypt>", "", $cadena);
        $cadena = str_ireplace("<scrypt src>", "", $cadena);
        $cadena = str_ireplace("<scrypt type>", "", $cadena);
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

    protected function sweet_alert($datos){

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
        }return $alerta;
    }
}
