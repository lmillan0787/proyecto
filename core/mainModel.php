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
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function validar_cedula_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM dat_per WHERE ced=:ced");
        $sql->bindParam(":ced", $datos['ced']);
        $sql->execute();
        return $sql;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function datos_persona_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM dat_per WHERE ced=:ced");
        $sql->bindParam(":ced", $datos['ced']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar region
    protected function consultar_evento_distinto_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM dat_even WHERE cod_even!=:cod_even AND cod_estat=1");
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar region
    protected function consultar_region_modelo(){
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_reg");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar region
    protected function consultar_disciplinas_modelo(){
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_dis");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar region
    protected function consultar_disciplinas_tipo_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_dis WHERE cod_tip_even=:cod_tip_even");
        $sql->bindParam(":cod_tip_even", $datos['cod_tip_even']);
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
    //consultar region
    protected function validar_disciplinas_evento_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM dat_even WHERE cod_even=:cod_even");
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar region
    protected function consultar_perfil_distinto_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_perf WHERE cod_perf!=:cod_perf and cod_rol=:cod_rol");
        $sql->bindParam(":cod_perf", $datos['cod_perf']);
        $sql->bindParam(":cod_rol", $datos['cod_rol']);
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
    //consultar estatus
    protected function consultar_cargo_modelo(){
        $consultaEstado = mainModel::conectar()->prepare("SELECT * FROM tab_carg");
        $consultaEstado->execute();
        $row = $consultaEstado->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar estatus
    protected function consultar_cargo_distinto($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_carg WHERE cod_carg!=:cod_carg");
        $sql->bindParam(":cod_carg", $datos['cod_carg']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar estatus
    protected function consultar_institucion_modelo(){
        $consultaEstado = mainModel::conectar()->prepare("SELECT * FROM tab_inst");
        $consultaEstado->execute();
        $row = $consultaEstado->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar estatus
    protected function consultar_institucion_distinta($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM tab_inst WHERE cod_inst!=:cod_inst");
        $sql->bindParam(":cod_inst", $datos['cod_inst']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar participacion
    protected function formulario_informacion_participacion_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT a.*,b.*,c.*,d.*,e.*,f.*,g.*,h.* FROM dat_par AS a INNER JOIN dat_per AS b ON a.cod_per=b.cod_per INNER JOIN dat_even AS c ON a.cod_even=c.cod_even INNER JOIN tab_perf AS d ON a.cod_perf=d.cod_perf INNER JOIN tab_estat AS e ON a.cod_estat=e.cod_estat LEFT JOIN dat_per_tec AS f ON f.cod_par=a.cod_par LEFT JOIN tab_carg AS g ON f.cod_carg=g.cod_carg LEFT JOIN tab_inst AS h ON f.cod_inst=h.cod_inst WHERE a.cod_par=:cod_par");
        $sql->bindParam(":cod_par", $datos['cod_par']);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar participacion
    protected function validar_persona_participacion_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM dat_par WHERE cod_per=:cod_per AND cod_even=:cod_even");
        $sql->bindParam(":cod_per", $datos['cod_per']);
        $sql->bindParam(":cod_even", $datos['cod_even']);
        $sql->execute();
        return $sql;
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
                            window.location='" . SERVERURL . "listaPersonas/';
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
                            window.location='" . SERVERURL . "listaEventos/';
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
                            window.location='" . SERVERURL . "listaDisciplinas/';
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
                            window.location='" . SERVERURL . "listaUsuarios/';
                        });
                    </script>
                ";
            
        } 
        return $alerta;
    }
}
