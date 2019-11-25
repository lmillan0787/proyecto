<?php

$peticionAjax = false;
include "./controllers/graficosControlador.php";
require_once "./controllers/eventoControlador.php";
$insGraficas = new graficosControlador();
$insEvento = new eventoControlador();
$var = explode("/", $_GET['views']);
$cod_even = $var[1];
$datos = [
    "cod_even" => $cod_even
];

?>
<!-- Barra de busqueda y boton -->
<nav class="navbar navbar-dark teal darken-1">
    <div id="titulo">
        <center>
            <h3>Estadísticas de <?php $insEvento->cabecera_nombre_evento_controlador($datos) ?></h3>
        </center>
    </div>
</nav>
<center>
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-6" id="circular" style="height: 300px"></div>
            <div class="col-6 col-md-6" id="regiones" style="height: 400px"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-6" id="container3" style="height: 400px"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-6" id="container4" style="height: 400px"></div>
        </div>
    </div>


    <script type="text/javascript">
        $(function() {
            $("#circular").highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    /////Titulo de encabezado////
                    text: "Participación por Regiones Porcentual <br>"
                },
                tooltip: {
                    pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>"
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: "pointer",
                        dataLabels: {
                            enabled: false
                        }
                    },
                    showInLegend: true
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
    <script type="text/javascript">
        $(function() {
            $('#regiones').highcharts({
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
                    text: 'Participacion por Regiones'
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
                    categories: [<?php $insGraficas->generar_grafica_regiones_controlador($datos); ?>],
                },
                yAxis: {
                    title: {
                        min: 0,
                        steep: 1,
                        text: null
                    }
                },
                series: [{
                    name: 'Regiones',
                    data: [<?php $insGraficas->generar_grafica_torta_controlador($datos); ?>]
                }]
                
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $('#container3').highcharts({
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
                    text: 'Participación por Pueblos <br>'
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
                        <?php $insGraficas->generar_grafica_pueblos_controlador($datos); ?>
                    ],
                },
                yAxis: {
                    title: {
                        text: null
                    }
                },
                tooltip: {
                    formatter: function() {
                        return '<b>' + this.series.name + '</b><br/>' +
                            this.point.y + ' ' + this.point.name.toLowerCase();
                    }
                },
                series: [{
                    name: 'Pueblos',
                    colorByPoint: true,
                    data: [<?php $insGraficas->generar_grafica_pueblos_controlador($datos); ?>]
                }]
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $('#container4').highcharts({
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
                    text: 'Participación por Disciplinas <br>'
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
</center>