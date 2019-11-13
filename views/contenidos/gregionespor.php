<?php

$peticionAjax = false;
include "./controllers/graficosControlador.php";
$insGraficas = new graficosControlador();
$cod_even=$_POST['cod_even'];
$des_even=$_POST['des_even'];
$datos=[
    "cod_even" => $cod_even,
    "des_even" => $des_even
]
?>
<script type="text/javascript">
    $(function() {
        $("#container").highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    /////Titulo de encabezado////
                    text: "Participación por Regiones Porcentual <br><?php echo $des_even ?>"
                },
                tooltip: {
                    pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>"
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: "pointer",
                        dataLabels: {
                            enabled: true,
                            format: "<b>{point.name}</b>: {point.percentage:.1f} %",
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || "black"
                            }
                        }
                    }
                },
                series: [{
                        ////tipo de grafico (tipo torta)////// se puede cambiar////
                        type: "pie",

                        allowPointSelect: true,

                        /////Nombre que sale al poner el mouse sobre el grafico
                        name: "Participantes",
                        data: [                   

                        <?php $insGraficas->generar_grafica_torta_controlador($datos); ?>

                    ]

                }]
        });
    });
</script>
<div id="container" style="height: 400px"></div>