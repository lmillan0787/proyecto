<?php
require_once 'conexion/conexion.php';
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Ejemplos de Columnas</title>
         <link rel="stylesheet" href="api/css/highcharts.css">
        <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
        <style type="text/css" >
#container {
    height: 400px; 
    min-width: 400px; 
    max-width: 800px;
    margin: 0 auto;
}
        </style>
      
<script type="text/javascript"> 

   

   $(function () {
    $('#container').highcharts({
        chart: {
            type: 'column',
        
            
            margin: [80,80],
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Participación por Eventos'
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

<?php
            $sql=mysqli_query($conexion,'SELECT COUNT(*) AS total,des_even FROM dat_even a INNER JOIN dat_par AS b ON a.cod_even=b.cod_even group by b.cod_even');
            while ($res=mysqli_fetch_array($sql)) { ?>

['<?php echo utf8_encode($res['des_even']) ?>'],

<?php } ?>
            ],
        },

        yAxis: {

            title: {
               
                text: null

            }
        },
        series: [{
            name: 'Eventos',
            colorByPoint: true,
            data: [ <?php
            $sql=mysqli_query($conexion,'SELECT COUNT(*) AS total,des_even FROM dat_even a INNER JOIN dat_par AS b ON a.cod_even=b.cod_even group by b.cod_even');
            while ($res=mysqli_fetch_array($sql)) { ?>
                
            ////Se imprime la consulta el tamaño deñ grafico y el nombre mientras esta el click encima///////
                ['<?php echo utf8_encode($res['des_even']);?>',   <?php echo $res['total'];?>],
            
            <?php
            }
            ?>   ]


        }]
    });
});
        </script>
    </head>
    <body>

<script src="js/highcharts.js"></script>
<script src="js/highcharts-3d.js"></script>
<script src="js/modules/exporting.js"></script>

<a href="index.php">Volver a Selección de Gráficos</a>

<div id="container" style="height: 400px"></div>
    </body>
</html>
