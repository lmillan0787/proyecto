<?php

$peticionAjax = false;
include "./controllers/graficosControlador.php";
require_once "./controllers/eventoControlador.php";
$insGraficas = new graficosControlador();
$insEvento = new eventoControlador();
$cod_even=$_POST['cod_even'];
$des_even=$_POST['des_even'];
$datos=[
    "cod_even" => $cod_even,
    "des_even" => $des_even
]

?>
<script type="text/javascript">
    $(function() {
        $('#container').highcharts({
            chart: {
                type: 'column',

                margin: [80, 80],
                options3d: {
                    enabled: true,
                    alpha: 10,
                    beta: 25,
                    depth: 70
                }
            },
            title: {
                text: 'Participación por Disciplinas <br><?php echo $des_even ?>'
            },



            subtitle: {
                //Aqui se puede agregar un subtitulo//
                text: ''
            },
            plotOptions: {

                column: {


                    depth: 25
                }
            },



            //////Titulos en la base del grafico//////
            xAxis: {

                categories: [

                    <?php $insGraficas->generar_grafica_disciplinas_nombres_controlador($datos) ?>
                ],
            },

            yAxis: {

                title: {

                    text: null

                }
            },
            series: [{
                name: 'Disciplinas',
                colorByPoint: true,
                data: [
                    <?php $insGraficas->generar_grafica_disciplinas_controlador($datos)  ?>
                ]


            }]
        });
    });
</script>


<div id="container" style="height: 400px"></div>